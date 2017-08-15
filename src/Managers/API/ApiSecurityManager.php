<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Managers\API;

use App\Model\User;
use App\Exceptions\ApiJsonException;
use Doctrine\ODM\MongoDB\DocumentManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class ApiSecurityManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiSecurityManager
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var JWTManager
     */
    private $tokenManager;

    /**
     * ApiSecurityManager constructor.
     *
     * @param DocumentManager               $documentManager
     * @param UserPasswordEncoderInterface  $passwordEncoder
     * @param JWTManager                    $tokenManager
     */
    public function __construct(
        DocumentManager $documentManager,
        UserPasswordEncoderInterface $passwordEncoder,
        JWTManager $tokenManager
    ) {
        $this->documentManager = $documentManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenManager = $tokenManager;
    }

    public function registerUserViaCredentials(array $credentials)
    {
        if (!$credentials) {
            throw new ApiJsonException(
                \sprintf(
                    ''
                )
            );
        }
    }

    /**
     * @param array $headers
     *
     * @throws ApiJsonException
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function authenticateUserViaHeaders(array $headers)
    {
        if (!$headers) {
            throw new ApiJsonException(
                \sprintf(
                    'No headers passed !'
                )
            );
        }

        $user = $this->documentManager->getRepository(User::class)
                                      ->findOneBy([
                                          'id' => $headers['client_id']
                                      ]);

        if (!$user) {
            throw new ApiJsonException(
                \sprintf(
                    'No user found using this headers/identifiers !'
                )
            );
        }

        $token = $this->tokenManager->create($user);

        $user->setToken($token);
        $user->setState(\uniqid('', false));

        $this->documentManager->flush();

        return [
            'response_type' => 'code',
            'token' => $token,
            'refresh_token' => '',
            'state' => $user->getState()
        ];
    }

    /**
     * @param array $credentials    The date used for authenticate the users.
     *
     * @throws ApiJsonException     If bad arguments are passed or empty.
     * @throws ApiJsonException     If no users can be found.
     *
     * @return string               The token if authenticated or false if not.
     */

    public function authenticateViaCredentials(array $credentials)
    {
        if ((!$credentials['username']) || (!$credentials['password'])) {
            throw new ApiJsonException(
                \sprintf(
                    'The request must contains the right arguments, waiting for username and password !'
                )
            );
        }

        $user = $this->documentManager->getRepository(User::class)
                                      ->findOneBy([
                                          'username' => $credentials['username']
                                      ]);

        if ((!$user) || (!$this->passwordEncoder->isPasswordValid($user, $credentials['password']))) {
            throw new ApiJsonException(
                \sprintf(
                    'The identifiers does not allow to find a user !'
                )
            );
        }

        return $this->tokenManager->create($user);
    }
}

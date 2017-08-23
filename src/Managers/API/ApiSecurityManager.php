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
use App\Events\Users\UserCreatedEvent;
use App\Exceptions\ApiJsonException;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
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
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var SerializerInterface
     */
    private $serializer;

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
     * @param DocumentManager $documentManager
     * @param ValidatorInterface $validator
     * @param EventDispatcherInterface $eventDispatcher
     * @param SerializerInterface $serializer
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param JWTManager $tokenManager
     */
    public function __construct(
        DocumentManager $documentManager,
        ValidatorInterface $validator,
        EventDispatcherInterface $eventDispatcher,
        SerializerInterface $serializer,
        UserPasswordEncoderInterface $passwordEncoder,
        JWTManager $tokenManager
    ) {
        $this->documentManager = $documentManager;
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
        $this->serializer = $serializer;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenManager = $tokenManager;
    }

    /**
     * @param string $credentials
     *
     * @throws ApiJsonException
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function registerUserViaCredentials(string $credentials)
    {
        if (!$credentials) {
            throw new ApiJsonException(
                \sprintf(
                    'Credentials must be passed to create a resource !'
                )
            );
        }

        $entry = new User();

        $this->serializer->deserialize(
            $credentials,
            User::class,
            'json',
            ['object_to_populate' => $entry]
        );

        $clone = $this->documentManager->getRepository(User::class)
                                       ->findOneBy([
                                           'username' => $entry->getUsername()
                                       ]);

        if ($clone) {
            return [
                'message' => 'Resource already found !',
                'data' => $this->serializer->serialize(
                    $clone,
                    'json'
                )
            ];
        }

       // $errors = $this->validator->validate($entry);

        // if ($errors) {
            // return [
                // 'errors' => $errors
            // ];
        // }

        $event = new UserCreatedEvent($entry);
        $this->eventDispatcher->dispatch($event::NAME, $event);

        $this->documentManager->persist($entry);
        $this->documentManager->flush();
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
                    'The identifiers does not allow to authenticate a user !'
                )
            );
        }

        return $this->tokenManager->create($user);
    }

    /**s
     * @param string $credentials           The user credentials needed for authentication.
     *
     * @throws ApiJsonException             If no credentials are found.
     * @throws ApiJsonException             If no user is found using credentials.
     * @throws \InvalidArgumentException    @see DocumentManager.
     *
     * @return string                       The token for resetting the password.
     */
    public function resetPasswordTokenViaCredentials(string $credentials)
    {
        if (!$credentials) {
            throw new ApiJsonException(
                \sprintf(
                    'No credentials passed !'
                )
            );
        }

        $entity = $this->serializer->deserialize(
            $credentials,
            User::class,
            'json'
        );

        $object = $this->documentManager->getRepository(User::class)
                                        ->findOneBy([
                                            'username' => $entity->getUsername(),
                                            'email' => $entity->getEmail()
                                        ]);

        if (!$object) {
            throw new ApiJsonException(
                \sprintf(
                    'No user found using this identifiers ! Given %s',
                    $credentials
                )
            );
        }

        $object->setResetPasswordToken($this->tokenManager->create($object));

        $this->documentManager->flush();

        return $object->getResetPasswordToken();
    }

    public function resetPasswordViaCredentials(string $credentials)
    {
        if (!$credentials) {
            throw new ApiJsonException(
                \sprintf(
                    'No credentials passed !'
                )
            );
        }

        $results = $this->serializer->deserialize(
            $credentials,
            User::class,
            'json'
        );

        $entity = $this->documentManager->getRepository(User::class)
                                        ->findOneBy([
                                            'resetPasswordToken' => $results->getResetPasswordToken()
                                        ]);

        if (!$entity) {
            throw new ApiJsonException(
                \sprintf(
                    ''
                )
            );
        }

    }
}

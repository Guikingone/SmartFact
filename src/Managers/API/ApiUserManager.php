<?php

/*
 * This file is part of the Smartfact project.
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
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\SerializerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

/**
 * Class ApiUserManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiUserManager
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var UserPasswordEncoder
     */
    private $passwordEncoder;

    /**
     * @var JWTManager
     */
    private $tokenManager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * ApiUserManager constructor.
     *
     * @param DocumentManager               $doctrine
     * @param SerializerInterface           $serializer
     * @param EventDispatcherInterface      $eventDispatcher
     * @param ValidatorInterface            $validator
     * @param UserPasswordEncoder           $passwordEncoder
     * @param JWTManager                    $tokenManager
     * @param RequestStack                  $requestStack
     */
    public function __construct(
        DocumentManager $documentManager,
        SerializerInterface $serializer,
        EventDispatcherInterface $eventDispatcher,
        ValidatorInterface $validator,
        UserPasswordEncoder $passwordEncoder,
        JWTManager $tokenManager,
        RequestStack $requestStack
    ) {
        $this->documentManager = $documentManager;
        $this->serializer = $serializer;
        $this->eventDispatcher = $eventDispatcher;
        $this->validator = $validator;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenManager = $tokenManager;
        $this->requestStack = $requestStack;
    }


    /**
     * Return all the Users.
     *
     * @return string       All the users saved.
     */
    public function getUsers()
    {
        $data = $this->documentManager->getRepository(User::class)
                                      ->findAll();

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['users']]
        );
    }

    /**
     * Return a single User using his id.
     *
     * @param int $id       The id of the User.
     *
     * @return string       The User informations requested.
     */
    public function getUserById($id)
    {
        $data = $this->documentManager->getRepository(User::class)
                                      ->findOneBy([
                                          'id' => $id
                                      ]);

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['users']]
        );
    }

    /**
     * @param array $data           The date used for authenticate the users.
     *
     * @throws ApiJsonException     If bad arguments are passed or empty.
     * @throws ApiJsonException     If no users can be found.
     *
     * @return bool|string          The token if authenticated or false if not.
     */
    public function authenticateUser(array $data)
    {
        if ((!$data['username']) || (!$data['password'])) {
            throw new ApiJsonException(
                \sprintf(
                    'The request must contains the right arguments, waiting for username and password !'
                )
            );
        }

        $user = $this->documentManager->getRepository(User::class)
                                      ->findOneBy([
                                          'username' => $data['username']
                                      ]);

        if (!$user) {
            throw new ApiJsonException(
                \sprintf(
                    'A users must be found using this identifiers !'
                )
            );
        }

        if ($this->passwordEncoder->isPasswordValid($user, $data['password'])) {
            return $this->tokenManager->create($user);
        }

        return false;
    }

    /**
     * @param array $data
     */
    public function postUsers(array $data)
    {

    }
}

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
use App\Events\Users\UserCreatedEvent;
use Doctrine\ORM\EntityManager;
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
     * @var EntityManager
     */
    private $entityManager;

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
     * @param EntityManager                 $entityManager
     * @param SerializerInterface           $serializer
     * @param EventDispatcherInterface      $eventDispatcher
     * @param ValidatorInterface            $validator
     * @param UserPasswordEncoder           $passwordEncoder
     * @param JWTManager                    $tokenManager
     * @param RequestStack                  $requestStack
     */
    public function __construct(
        EntityManager $entityManager,
        SerializerInterface $serializer,
        EventDispatcherInterface $eventDispatcher,
        ValidatorInterface $validator,
        UserPasswordEncoder $passwordEncoder,
        JWTManager $tokenManager,
        RequestStack $requestStack
    ) {
        $this->entityManager = $entityManager;
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
    public function getUsers() : string
    {
        $users = $this->entityManager->getRepository(User::class)
                                       ->findAll();

        return $this->serializer->serialize(
            $users,
            'json',
            ['groups' => ['users']]
        );
    }

    /**
     * @param string $apiToken          The api key used to authenticate the client.
     *
     * @throws ApiJsonException         Thrown if no api key is passed.
     * @throws ApiJsonException         Thrown if no user is found using the api key.
     *
     * @return string                   The user informations
     */
    public function getPersonalUser(string $apiToken) : string
    {
        $entity = $this->entityManager->getRepository(User::class)
                                        ->findOneBy([
                                            'apiToken' => $apiToken
                                        ]);

        if (!$entity) {
            throw new ApiJsonException(
                \sprintf(
                    'No user found using this identifier !'
                )
            );
        }

        return $this->serializer->serialize(
            $entity,
            'json',
            ['groups' => ['personal']]
        );
    }

    /**
     * Return a single User using his id.
     *
     * @param int $id       The id of the User.
     *
     * @return string       The User informations requested.
     */
    public function getUserById(int $id) : string
    {
        $object = $this->entityManager->getRepository(User::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        return $this->serializer->serialize(
            $object,
            'json',
            ['groups' => ['users']]
        );
    }

    /**
     * @param string $data
     *
     * @throws ApiJsonException                If no data are passed.
     * @throws \InvalidArgumentException
     *
     * @return array|string
     */
    public function postUsers(string $data)
    {
        if (!$data) {
            throw new ApiJsonException(
                \sprintf(
                    'Expecting data !'
                )
            );
        }

        $user = new User();

        $object = $this->serializer->deserialize(
            $data,
            User::class,
            'json',
            ['object_to_populate' => $user]
        );

        $clone = $this->entityManager->getRepository(User::class)
                                       ->findOneBy([
                                           'firstname' => $user->getFirstName()
                                       ]);

        if ($clone) {
            return [
                'message' => 'Resource already exist !',
                'data' => $this->serializer->serialize(
                    $clone,
                    'json'
                )
            ];
        }

        $this->validator->validate($object);
        $event = new UserCreatedEvent($object);
        $this->eventDispatcher->dispatch($event::NAME, $event);

        $this->entityManager->persist($object);
        $this->entityManager->flush();

        return $this->serializer->serialize(
            $object,
            'json'
        );
    }

    /**
     * @param int $id
     * @param string $data
     *
     * @throws ApiJsonException
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function patchUsers(int $id, string $data) : string
    {
        $object = $this->entityManager->getRepository(User::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        if (!$object) {
            throw new ApiJsonException(
                \sprintf(
                    'No user can be found using credentials !'
                )
            );
        }

        $this->serializer->deserialize(
            $data,
            User::class,
            'json',
            ['object_to_populate' => $object]
        );

        $this->entityManager->flush();

        return $this->serializer->serialize(
            $object,
            'json'
        );
    }

    /**
     * @param string $id                    The id of the resource.
     *
     * @throws \InvalidArgumentException    Thrown by the entityManager.
     *
     * @throws ApiJsonException             If no resource are found.
     */
    public function deleteUser(string $id) : void
    {
        $entity = $this->entityManager->getRepository(User::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        if (!$entity) {
            throw new ApiJsonException(
                \sprintf(
                    'No resource can be found using this identifier, given %d',
                    $id
                )
            );
        }

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}

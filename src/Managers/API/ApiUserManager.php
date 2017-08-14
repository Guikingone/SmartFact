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

    public function getPersonalUser(string $identifier)
    {
        $user = $this->documentManager->getRepository(User::class)
                                      ->findOneBy([
                                          'id' => $identifier
                                      ]);

        if (!$user) {

        }

        return $this->serializer->serialize(
            $user,
            'json',
            ['groups' => ['personal']]
        );
    }

    /**
     * @param string $data
     *
     * @throws ApiJsonException        If no data are passed.
     *
     * @return string
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

        $object = $this->serializer->deserialize(
            $data,
            User::class,
            'json'
        );

        $clone = $this->documentManager->getRepository(User::class)
                                       ->findOneBy([
                                           'firstname' => $object->getFirstname()
                                       ]);

        if ($clone) {
            return \json_encode([
                'message' => 'Resource already exist !',
                'data' => $clone
            ]);
        }

        $this->validator->validate($object);
        $event = new UserCreatedEvent($object);
        $this->eventDispatcher->dispatch($event::NAME, $event);

        $this->documentManager->persist($object);
        $this->documentManager->flush();

        return $object;
    }

    /**
     * @param int $id
     * @param string $data
     */
    public function putUsers(int $id, string $data)
    {

    }

    /**
     * @param int $id
     * @param string $data
     */
    public function patchUsers(int $id, string $data)
    {

    }

    /**
     * @param int $id               The id of the resource.
     *
     * @throws ApiJsonException     If no resource are found.
     */
    public function deleteUser(int $id)
    {
        $entity = $this->documentManager->getRepository(User::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        if (!$entity) {
            throw new ApiJsonException(
                \sprintf(
                    'No resource can be found using this identifier, given %d', $id
                )
            );
        }

        $this->documentManager->remove($entity);
        $this->documentManager->flush();
    }
}

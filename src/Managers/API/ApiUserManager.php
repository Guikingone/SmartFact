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

// Symfony core
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

// Bundle
use App\Resolvers\User;

/**
 * Class ApiUserManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiUserManager
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var EntityManagerInterface */
    private $doctrine;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /** @var ValidatorInterface */
    private $validator;

    /** @var RequestStack */
    private $requestStack;

    /**
     * ApiUserManager constructor.
     *
     * @param SerializerInterface       $serializer
     * @param EntityManagerInterface    $doctrine
     * @param EventDispatcherInterface  $eventDispatcher
     * @param ValidatorInterface        $validator
     * @param RequestStack              $requestStack
     */
    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $doctrine,
        EventDispatcherInterface $eventDispatcher,
        ValidatorInterface $validator,
        RequestStack $requestStack
    ) {
        $this->serializer = $serializer;
        $this->doctrine = $doctrine;
        $this->eventDispatcher = $eventDispatcher;
        $this->validator = $validator;
        $this->requestStack = $requestStack;
    }

    /**
     * Return all the Users.
     *
     * @return string
     */
    public function getUsers()
    {
        $data = $this->doctrine->getRepository(User::class)
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
        $data = $this->doctrine->getRepository(User::class)
                               ->findOneBy([
                                   'id' => $id
                               ]);

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['users']]
        );
    }

    public function postUsers($data)
    {

    }
}

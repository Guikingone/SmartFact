<?php

/*
 * This file is part of the Smartfact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Managers\API;

// Symfony core
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

// Bundle
use AppBundle\Entity\User;

/**
 * Class ApiUserManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiUserManager
{
    /** @var Serializer */
    private $serializer;

    /** @var EntityManager */
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
     * @param Serializer $serializer
     * @param EntityManager $doctrine
     * @param EventDispatcherInterface $eventDispatcher
     * @param ValidatorInterface $validator
     * @param RequestStack $requestStack
     */
    public function __construct(
        Serializer $serializer,
        EntityManager $doctrine,
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
     *
     * @return array|null
     */
    public function getUsers()
    {
        $data = $this->doctrine->getRepository(User::class)
                               ->findAll();

        if (!$data) {
            return null;
        }

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['users']]
        );
    }

    public function postUsers()
    {
    }
}

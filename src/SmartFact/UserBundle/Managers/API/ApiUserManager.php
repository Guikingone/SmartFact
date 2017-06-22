<?php

/*
 * This file is part of the Smartfact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SmartFact\UserBundle\Managers\API;

// Symfony core
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

// Bundle
use SmartFact\UserBundle\Entity\User;

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
     * Allow to retrieve all the users.
     *
     * @return JsonResponse|Response
     */
    public function getUsers()
    {
        $data = $this->doctrine->getRepository(User::class)->findAll();

        if (!$data) {
            return new JsonResponse(
                [
                    'message' => 'Resource not found'
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $users = $this->serializer->serialize($data, 'json', ['groups' => ['users']]);

        return new Response(
            [
                'data' => $users
            ],
            Response::HTTP_OK
        );
    }

    public function postUsers()
    {

    }
}

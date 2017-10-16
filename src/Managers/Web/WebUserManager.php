<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Managers\Web;

use App\Model\User;

// Events
use App\Events\Users\UserCreatedEvent;
use App\Events\Users\UserUpdatedEvent;

// Form
use App\Form\Type\Users\UpdateUserType;
use App\Form\Type\Security\RegisterType;

// Core
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class WebUserManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebUserManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $form;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * WebUserManager constructor.
     *
     * @param EntityManager             $entityManager
     * @param FormFactoryInterface      $form
     * @param EventDispatcherInterface  $eventDispatcher
     */
    public function __construct(
        EntityManager $entityManager,
        FormFactoryInterface $form,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager = $entityManager;
        $this->form = $form;
        $this->eventDispatcher = $eventDispatcher;
    }


    /**
     * Return all the Users.
     *
     * @return User[]|array
     */
    public function getUsers()
    {
        return $this->entityManager->getRepository(User::class)
                                     ->findAll();
    }

    /**
     * @param int $id
     *
     * @return User|null
     */
    public function getUserById($id)
    {
        return $this->entityManager->getRepository(User::class)
                                     ->findOneBy([
                                         'id' => $id
                                     ]);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormView
     */
    public function postUser(Request $request)
    {
        $user = new User();

        $form = $this->form->create(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new UserCreatedEvent($user);
            $this->eventDispatcher->dispatch(
                UserCreatedEvent::NAME,
                $event
            );
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $form->createView();
    }

    /**
     * @param string $token
     * @param int $id
     *
     * @throws \InvalidArgumentException
     */
    public function validateUser(string $token, int $id)
    {
        $user = $this->entityManager->getRepository(User::class)
                                      ->findOneBy([
                                          'id' => $id,
                                          'token' => $token
                                      ]);

        if (!$user) {
            throw new \InvalidArgumentException(
                \sprintf(
                    ''
                )
            );
        }


    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @throws \InvalidArgumentException
     *
     * @return \Symfony\Component\Form\FormView
     */
    public function updateUser(Request $request, int $id)
    {
        $user = $this->entityManager->getRepository(User::class)
                                      ->findOneBy([
                                          'id' => $id
                                      ]);

        if (!$user) {
            throw new \InvalidArgumentException(
                \sprintf(
                    'An users must be found using the id passed !
                            Given %s', $id
                )
            );
        }

        $form = $this->form->create(UpdateUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new UserUpdatedEvent($user);
            $this->eventDispatcher->dispatch(
                UserUpdatedEvent::NAME,
                $event
            );
            $this->entityManager->flush();
        }

        return $form->createView();
    }

    /**
     * Delete a User using his id.
     *
     * @param int $id       The id of the User.
     */
    public function deleteUser($id)
    {
        $user = $this->entityManager->getRepository(User::class)
                                      ->findOneBy([
                                          'id' => $id
                                      ]);

        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}

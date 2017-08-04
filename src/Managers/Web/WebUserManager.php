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

use App\Events\Users\UserUpdatedEvent;
use App\Model\User;
use App\Events\Users\UserCreatedEvent;
use App\Form\Type\Security\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
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
     * @var EntityManagerInterface
     */
    private $doctrine;

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
     * @param EntityManagerInterface    $doctrine
     * @param FormFactoryInterface      $form
     * @param EventDispatcherInterface  $eventDispatcher
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        FormFactoryInterface $form,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->doctrine = $doctrine;
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
        return $this->doctrine->getRepository(User::class)
                              ->findAll();
    }

    /**
     * @param int $id
     *
     * @return User|null|object
     */
    public function getUserById($id)
    {
        return $this->doctrine->getRepository(User::class)
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
            $this->doctrine->persist($user);
            $this->doctrine->flush();
        }

        return $form->createView();
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
        $user = $this->doctrine->getRepository(User::class)
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

        $form = $this->form->create(UpdatUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = new UserUpdatedEvent($user);
            $this->eventDispatcher->dispatch(
                UserUpdatedEvent::NAME,
                $event
            );
            $this->doctrine->flush();
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
        $user = $this->doctrine->getRepository(User::class)
                               ->findOneBy([
                                   'id' => $id
                               ]);

        $this->doctrine->remove($user);
        $this->doctrine->flush();
    }
}

<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Managers\Web;

use AppBundle\Entity\User;
use AppBundle\Form\Type\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Class WebUserManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebUserManager
{
    /** @var EntityManagerInterface */
    private $doctrine;

    /** @var FormFactoryInterface */
    private $form;

    /**
     * WebUserManager constructor.
     *
     * @param EntityManagerInterface    $doctrine
     * @param FormFactoryInterface      $form
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        FormFactoryInterface $form
    ) {
        $this->doctrine = $doctrine;
        $this->form = $form;
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
     * @return User|null
     */
    public function getUserById($id)
    {
        return $this->doctrine->getRepository(User::class)
                              ->findOneBy([
                                  'id' => $id
                              ]);
    }

    public function postUser($request)
    {
        $user = new User();

        $form = $this->form->create(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->persist($user);
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

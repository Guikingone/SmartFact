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
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class WebUserManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebUserManager
{
    /** @var EntityManagerInterface */
    private $doctrine;

    /** @var FormFactory */
    private $form;

    /**
     * WebUserManager constructor.
     *
     * @param EntityManagerInterface        $doctrine
     * @param FormFactory                   $form
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        FormFactory $form
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
}

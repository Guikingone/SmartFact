<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Model;

use App\Interfaces\SmartFactAccountingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Accounting
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Accounting implements SmartFactAccountingInterface
{
    /**
     * @var int
     *
     * @Groups({"users", "accounting"})
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"users", "accounting"})
     */
    private $name;

    /**
     * @var string
     *
     * @Groups({"users", "accounting"})
     */
    private $interlocutor;

    /**
     * @var string
     *
     * @Groups({"users", "accounting"})
     */
    private $address;

    /**
     * @var string
     *
     * @Groups({"users", "accounting"})
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @Groups({"users", "accounting"})
     */
    private $email;

    /**
     * @var User
     *
     * @Groups({"accounting"})
     */
    private $users;

    /**
     * Accounting constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getInterlocutor()
    {
        return $this->interlocutor;
    }

    /**
     * {@inheritdoc}
     */
    public function setInterlocutor(string $interlocutor)
    {
        $this->interlocutor = $interlocutor;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsers()
    {
        return $this->users;
    }
}

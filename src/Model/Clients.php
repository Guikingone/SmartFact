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

use App\Interfaces\SmartFactClientsInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Clients
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Clients implements SmartFactClientsInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $prestationType;

    private $user;

    private $bills;

    private $meetup;

    /**
     * Clients constructor.
     */
    public function __construct()
    {
        $this->bills = new ArrayCollection();
        $this->meetup = new ArrayCollection();
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
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber() : string
    {
        return $this->phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrestationType() : string
    {
        return $this->prestationType;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrestationType($prestationType)
    {
        $this->prestationType = $prestationType;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function addBills(Bills $bills)
    {
        $this->bills[] = $bills;
    }

    /**
     * {@inheritdoc}
     */
    public function removeBills(Bills $bills)
    {
        $this->bills->removeElement($bills);
    }

    /**
     * {@inheritdoc}
     */
    public function getBills() : ArrayCollection
    {
        return $this->bills;
    }

    /**
     * {@inheritdoc}
     */
    public function addMeetup(Meetup $meetup)
    {
        $this->meetup[] = $meetup;
    }

    /**
     * {@inheritdoc}
     */
    public function removeMeetup(Meetup $meetup)
    {
        $this->meetup->removeElement($meetup);
    }

    /**
     * {@inheritdoc}
     */
    public function getMeetups() : ArrayCollection
    {
        return $this->meetup;
    }
}

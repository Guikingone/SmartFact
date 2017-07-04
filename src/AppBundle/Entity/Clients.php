<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Interfaces\SmartFactClientsInterface;

/**
 * Class Clients
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_clients")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientsRepository")
 */
class Clients implements SmartFactClientsInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=150)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=15)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="prestation_type", type="string", length=100)
     */
    private $prestationType;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="clients")
     */
    private $user;

    /**
     * @var Bills
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bills", mappedBy="clients")
     */
    private $bills;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Meetup", mappedBy="clients")
     */
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPrestationType()
    {
        return $this->prestationType;
    }

    /**
     * @param string $prestationType
     */
    public function setPrestationType($prestationType)
    {
        $this->prestationType = $prestationType;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Bills $bills
     */
    public function addBills(Bills $bills)
    {
        $this->bills[] = $bills;
    }

    /**
     * @param Bills $bills
     */
    public function removeBill(Bills $bills)
    {
        $this->bills->removeElement($bills);
    }

    /**
     * @return Bills|ArrayCollection
     */
    public function getBills()
    {
        return $this->bills;
    }

    /**
     * @param Meetup $meetup
     */
    public function addMeetup(Meetup $meetup)
    {
        $this->meetup[] = $meetup;
    }

    /**
     * @param Meetup $meetup
     */
    public function removeMeetup(Meetup $meetup)
    {
        $this->meetup->removeElement($meetup);
    }

    /**
     * @return ArrayCollection
     */
    public function getMeetups()
    {
        return $this->meetup;
    }
}

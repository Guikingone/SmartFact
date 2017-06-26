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

// Core
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

// Interface
use AppBundle\Interfaces\SmartFactUserInterface;

/**
 * Class User
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements SmartFactUserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"users"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string")
     *
     * @Groups({"users"})
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string")
     *
     * @Groups({"users"})
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string")
     *
     * @Groups({"users"})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=14)
     *
     * @Groups({"users"})
     */
    private $phoneNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     *
     * @Groups({"users"})
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=150)
     *
     * @Groups({"users"})
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date")
     *
     * @Groups({"users"})
     */
    private $createdAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     *
     * @Groups({"users"})
     */
    private $validated;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     *
     * @Groups({"users"})
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=200, nullable=false)
     *
     * @Groups({"users"})
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=150)
     */
    private $token;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     *
     * @Groups({"users"})
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Notifications", mappedBy="user")
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Clients", mappedBy="user")
     */
    private $clients;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Accounting", inversedBy="user")
     */
    private $accounting;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bills", mappedBy="user")
     */
    private $bills;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Planning", mappedBy="user")
     */
    private $planning;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->isActive = true;
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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstName)
    {
        $this->firstname = $firstName;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastName)
    {
        $this->lastname = $lastName;
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
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return bool
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param bool $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param string $roles
     */
    public function addRoles($roles)
    {
        $this->roles[] = $roles;
    }

    /** @codeCoverageIgnore */
    public function eraseCredentials()
    {
    }

    /** @codeCoverageIgnore */
    public function isAccountNonExpired()
    {
        return true;
    }

    /** @codeCoverageIgnore */
    public function isAccountNonLocked()
    {
        return true;
    }

    /** @codeCoverageIgnore */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /** @codeCoverageIgnore */
    public function getSalt()
    {
        return null;
    }

    /**
     * @see \Serializable::serialize()
     *
     * @codeCoverageIgnore
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
        ]);
    }

    /**
     * @see \Serializable::unserialize()
     *
     * @codeCoverageIgnore
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            ) = unserialize($serialized);
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add notification
     *
     * @param \AppBundle\Entity\Notifications $notification
     *
     * @return User
     */
    public function addNotification(\AppBundle\Entity\Notifications $notification)
    {
        $this->notifications[] = $notification;

        return $this;
    }

    /**
     * Remove notification
     *
     * @param \AppBundle\Entity\Notifications $notification
     */
    public function removeNotification(\AppBundle\Entity\Notifications $notification)
    {
        $this->notifications->removeElement($notification);
    }

    /**
     * Get notifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Add client
     *
     * @param \AppBundle\Entity\Clients $client
     *
     * @return User
     */
    public function addClient(\AppBundle\Entity\Clients $client)
    {
        $this->clients[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \AppBundle\Entity\Clients $client
     */
    public function removeClient(\AppBundle\Entity\Clients $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Set accounting
     *
     * @param \AppBundle\Entity\Accounting $accounting
     *
     * @return User
     */
    public function setAccounting(\AppBundle\Entity\Accounting $accounting = null)
    {
        $this->accounting = $accounting;

        return $this;
    }

    /**
     * Get accounting
     *
     * @return \AppBundle\Entity\Accounting
     */
    public function getAccounting()
    {
        return $this->accounting;
    }

    /**
     * Add bill
     *
     * @param \AppBundle\Entity\Bills $bill
     *
     * @return User
     */
    public function addBill(\AppBundle\Entity\Bills $bill)
    {
        $this->bills[] = $bill;

        return $this;
    }

    /**
     * Remove bill
     *
     * @param \AppBundle\Entity\Bills $bill
     */
    public function removeBill(\AppBundle\Entity\Bills $bill)
    {
        $this->bills->removeElement($bill);
    }

    /**
     * Get bills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBills()
    {
        return $this->bills;
    }

    /**
     * Set planning
     *
     * @param \AppBundle\Entity\Planning $planning
     *
     * @return User
     */
    public function setPlanning(\AppBundle\Entity\Planning $planning = null)
    {
        $this->planning = $planning;

        return $this;
    }

    /**
     * Get planning
     *
     * @return \AppBundle\Entity\Planning
     */
    public function getPlanning()
    {
        return $this->planning;
    }
}

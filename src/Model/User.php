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

use App\Interfaces\SmartFactUserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class User implements SmartFactUserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

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
    private $email;

    /**
     * @var \DateTime
     */
    private $birthdate;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var bool
     */
    private $validated;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     */
    private $token;

    /**
     * @var array
     */
    private $roles;

    private $notifications;

    private $clients;

    private $accounting;

    private $bills;

    private $planning;

    private $meetups;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->meetup = new ArrayCollection();
        $this->isActive = true;
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
    public function getFirstname() : string
    {
        return $this->firstname;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstname(string $firstName)
    {
        $this->firstname = $firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastname() : string
    {
        return $this->lastname;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastname(string $lastName)
    {
        $this->lastname = $lastName;
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
    public function setAddress(string $address)
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
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail() : string
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
    public function getBirthDate() : \DateTime
    {
        return $this->birthdate;
    }

    /**
     * {@inheritdoc}
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * {@inheritdoc}
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
        return \serialize([
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
            ) = \unserialize($serialized);
    }

    /**
     * Add notification
     *
     * @param Notifications $notification
     *
     * @return User
     */
    public function addNotification(Notifications $notification)
    {
        $this->notifications[] = $notification;

        return $this;
    }

    /**
     * Remove notification
     *
     * @param Notifications $notification
     */
    public function removeNotification(Notifications $notification)
    {
        $this->notifications->removeElement($notification);
    }

    /**
     * Get notifications
     *
     * @return Collection
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Add client
     *
     * @param Clients $client
     *
     * @return User
     */
    public function addClient(Clients $client)
    {
        $this->clients[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param Clients $client
     */
    public function removeClient(Clients $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Get clients
     *
     * @return Collection
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Set accounting
     *
     * @param Accounting $accounting
     *
     * @return User
     */
    public function setAccounting(Accounting $accounting = null)
    {
        $this->accounting = $accounting;

        return $this;
    }

    /**
     * Get accounting
     *
     * @return \AppBundle\Model\Accounting
     */
    public function getAccounting()
    {
        return $this->accounting;
    }

    /**
     * Add bill
     *
     * @param Bills $bill
     *
     * @return User
     */
    public function addBill(Bills $bill)
    {
        $this->bills[] = $bill;

        return $this;
    }

    /**
     * Remove bill
     *
     * @param Bills $bill
     */
    public function removeBill(Bills $bill)
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
     * @param Planning $planning
     *
     * @return User
     */
    public function setPlanning(Planning $planning = null)
    {
        $this->planning = $planning;

        return $this;
    }

    /**
     * Get planning
     *
     * @return Planning
     */
    public function getPlanning()
    {
        return $this->planning;
    }

    /**
     * Add Meetup
     *
     * @param Meetup $meetup
     *
     * @return User
     */
    public function addMeetup(Meetup $meetup)
    {
        $this->meetups[] = $meetup;

        return $this;
    }

    /**
     * Remove meetup
     *
     * @param Meetup $meetup
     */
    public function removeMeetup(Meetup $meetup)
    {
        $this->meetups->removeElement($meetup);
    }

    /**
     * Get meetups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetups()
    {
        return $this->meetups;
    }
}

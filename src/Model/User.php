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
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class User
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class User implements SmartFactUserInterface
{
    /**
     * @var int
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $firstname;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $lastname;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $address;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $birthdate;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @Groups({"users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $createdAt;

    /**
     * @var bool
     *
     * @Groups({"users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $validated;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
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
    private $resetPasswordToken;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     *
     * @Groups({"users", "notifications", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $roles;

    /**
     * @var string
     *
     * @Groups({"personal"})
     */
    private $scope;

    /**
     * @var string
     *
     * @Groups({"personal"})
     */
    private $state;

    /**
     * @var ArrayCollection
     *
     * @Groups({"users", "planning", "accounting", "bills", "clients", "meetups"})
     */
    private $notifications;

    /**
     * @var ArrayCollection
     *
     * @Groups({"users", "notifications", "planning", "accounting", "bills", "meetups"})
     */
    private $clients;

    /**
     * @var
     *
     * @Groups({"users", "planning", "bills", "clients", "meetups"})
     */
    private $accounting;

    /**
     * @var ArrayCollection
     *
     * @Groups({"users", "notifications", "planning", "accounting", "clients", "meetups"})
     */
    private $bills;

    /**
     * @var
     *
     * @Groups({"users", "notifications", "accounting", "bills", "clients", "meetups"})
     */
    private $planning;

    /**
     * @var ArrayCollection
     *
     * @Groups({"users", "notifications", "planning", "accounting", "bills", "clients"})
     */
    private $meetups;

    const CREATED = 'created';

    const VALIDATED = 'validated';

    const ACTIVATED = 'activated';

    const UPDATED = 'updated';

    const LOCKED = 'locked';

    const PROFESSIONAL_USER = 'professional_user';

    const PARTICULAR_USER = 'particular_user';

    const API_USER = 'api_user';

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->meetups = new ArrayCollection();

        $this->createdAt = new \DateTime();
        $this->status = static::CREATED;
        $this->validated = false;
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
    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName(string $firstName)
    {
        $this->firstname = $firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName(string $lastName)
    {
        $this->lastname = $lastName;
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
    public function getBirthDate()
    {
        return $this->birthdate;
    }

    /**
     * {@inheritdoc}
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthdate = $birthDate;
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
    public function setPassword(string $password)
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
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getResetPasswordToken()
    {
        return $this->resetPasswordToken;
    }

    /**
     * @param string $resetPasswordToken
     */
    public function setResetPasswordToken(string $resetPasswordToken)
    {
        $this->resetPasswordToken = $resetPasswordToken;
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     */
    public function setApiToken(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoles(string $roles)
    {
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * {@inheritdoc}
     */
    public function setScope(string $scope)
    {
        $this->scope = $scope;
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState(string $state)
    {
        $this->state = $state;
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

    /**
     * @return bool
     */
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
     * @return \App\Model\Accounting
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

<?php

declare(strict_types=1);

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Models;

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\NotificationInterface;

/**
 * Class User
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class User implements UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $plainPassword;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var \DateTime
     */
    protected $validationDate;

    /**
     * @var string
     */
    protected $validationToken;

    /**
     * @var bool
     */
    protected $validated;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var string
     */
    protected $resetToken;

    /**
     * @var string
     */
    protected $apiToken;

    /**
     * @var ImageInterface
     */
    protected $image;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var \ArrayAccess
     */
    protected $notifications;

    /**
     * {@inheritdoc}
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName():? string
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName():? string
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): string
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
    public function getPlainPassword(): string
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
     * {@inheritdoc}
     */
    public function getPassword(): string
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
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function addRole(string $role)
    {
        $this->roles[] = $role;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreationDate(): string
    {
        return $this->creationDate->format('D d-M-Y H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationDate():? string
    {
        return $this->validationDate->format('D d-M-Y H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setValidationDate(\DateTime $validationDate)
    {
        $this->validationDate = $validationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationToken():? string
    {
        return $this->validationToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidationToken(string $validationToken)
    {
        $this->validationToken = $validationToken;
    }

    /**
     * {@inheritdoc}
     */
    public function hasBeenValidated(): bool
    {
        return $this->validated;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidated(bool $validated)
    {
        $this->validated = $validated;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAnActiveAccount(): bool
    {
        return $this->active;
    }

    /**
     * {@inheritdoc}
     */
    public function setActiveAccount(bool $activeAccount)
    {
        $this->active = $activeAccount;
    }

    /**
     * {@inheritdoc}
     */
    public function getResetToken():? string
    {
        return $this->resetToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setResetToken(string $resetToken)
    {
        $this->resetToken = $resetToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiToken():? string
    {
        return $this->apiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiToken(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage():? ImageInterface
    {
        return $this->image;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage(ImageInterface $image)
    {
        $this->image = $image;
    }

    /**
     * {@inheritdoc}
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * {@inheritdoc}
     */
    public function setCompany(CompanyInterface $company)
    {
        $this->company = $company;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotifications(): \ArrayAccess
    {
        return $this->notifications;
    }

    /**
     * {@inheritdoc}
     */
    public function addNotification(NotificationInterface $notification)
    {
        $this->notifications[] = $notification;
    }

    /**
     * {@inheritdoc}
     */
    public function removeNotification(NotificationInterface $notification)
    {
        unset($this->notifications[array_search($notification, (array) $this->notifications, true)]);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function serialize()
    {
        return serialize([
                $this->id,
                $this->username,
                $this->password
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }
}

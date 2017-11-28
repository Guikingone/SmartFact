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

namespace App\Models\Interfaces;

/**
 * Interface UserInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserInterface extends \Serializable
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return null|string
     */
    public function getFirstName():? string;

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName);

    /**
     * @return null|string
     */
    public function getLastName():? string;

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName);

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @param string $username
     */
    public function setUsername(string $username);

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     */
    public function setEmail(string $email);

    /**
     * @return null|string
     */
    public function getPlainPassword():? string;

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword);

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @param string $password
     */
    public function setPassword(string $password);

    /**
     * @return array
     */
    public function getRoles(): array;

    /**
     * @param string $role
     */
    public function addRole(string $role);

    /**
     * @return string
     */
    public function getCreationDate(): string;

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate);

    /**
     * @return null|string
     */
    public function getValidationDate():? string;

    /**
     * @param \DateTime $validationDate
     */
    public function setValidationDate(\DateTime $validationDate);

    /**
     * @return null|string
     */
    public function getValidationToken():? string;

    /**
     * @param string $validationToken
     */
    public function setValidationToken(string $validationToken);

    /**
     * @return bool
     */
    public function hasBeenValidated(): bool;

    /**
     * @param bool $validated
     */
    public function setValidated(bool $validated);

    /**
     * @return bool
     */
    public function hasAnActiveAccount(): bool;

    /**
     * @param bool $activeAccount
     */
    public function setActiveAccount(bool $activeAccount);

    /**
     * @return null|string
     */
    public function getResetToken():? string;

    /**
     * @param string $resetToken
     */
    public function setResetToken(string $resetToken);

    /**
     * @return null|string
     */
    public function getApiToken():? string;

    /**
     * @param string $apiToken
     */
    public function setApiToken(string $apiToken);

    /**
     * @return string
     */
    public function getTaxesIdentifier(): string;

    /**
     * @param string $taxesIdentifier
     */
    public function setTaxesIdentifier(string $taxesIdentifier);

    /**
     * @return string
     */
    public function getFormat(): string;

    /**
     * @param string $format
     */
    public function setFormat(string $format);

    /**
     * @return ImageInterface|null
     */
    public function getImage():? ImageInterface;

    /**
     * @param ImageInterface $image
     */
    public function setImage(ImageInterface $image);

    /**
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @param CompanyInterface $company
     */
    public function setCompany(CompanyInterface $company);

    /**
     * @return \ArrayAccess
     */
    public function getNotifications(): \ArrayAccess;

    /**
     * @param NotificationInterface $notification
     */
    public function addNotification(NotificationInterface $notification);

    /**
     * @param NotificationInterface $notification
     */
    public function removeNotification(NotificationInterface $notification);
}

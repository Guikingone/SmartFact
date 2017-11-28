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

namespace App\Builders\Interfaces;

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\NotificationInterface;

/**
 * Interface UserBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface UserBuilderInterface
{
    /**
     * @return UserBuilderInterface
     */
    public function create(): UserBuilderInterface;

    /**
     * @param UserInterface $user
     *
     * @return UserBuilderInterface
     */
    public function setUser(UserInterface $user): UserBuilderInterface;

    /**
     * @param string $firstName
     *
     * @return UserBuilderInterface
     */
    public function withFirstName(string $firstName): UserBuilderInterface;

    /**
     * @param string $lastName
     *
     * @return UserBuilderInterface
     */
    public function withLastName(string $lastName): UserBuilderInterface;

    /**
     * @param string $username
     *
     * @return UserBuilderInterface
     */
    public function withUsername(string $username): UserBuilderInterface;

    /**
     * @param string $email
     *
     * @return UserBuilderInterface
     */
    public function withEmail(string $email): UserBuilderInterface;

    /**
     * @param string $plainPassword
     *
     * @return UserBuilderInterface
     */
    public function withPlainPassword(string $plainPassword): UserBuilderInterface;

    /**
     * @param string $password
     *
     * @return UserBuilderInterface
     */
    public function withPassword(string $password): UserBuilderInterface;

    /**
     * @param string $role
     *
     * @return UserBuilderInterface
     */
    public function withRole(string $role): UserBuilderInterface;

    /**
     * @param \DateTime $creationDate
     *
     * @return UserBuilderInterface
     */
    public function withCreationDate(\DateTime $creationDate): UserBuilderInterface;

    /**
     * @param \DateTime $validationDate
     *
     * @return UserBuilderInterface
     */
    public function withValidationDate(\DateTime $validationDate): UserBuilderInterface;

    /**
     * @param string $validationToken
     *
     * @return UserBuilderInterface
     */
    public function withValidationToken(string $validationToken): UserBuilderInterface;

    /**
     * @param bool $validated
     *
     * @return UserBuilderInterface
     */
    public function withValidated(bool $validated): UserBuilderInterface;

    /**
     * @param bool $active
     *
     * @return UserBuilderInterface
     */
    public function withActive(bool $active): UserBuilderInterface;

    /**
     * @param string $resetToken
     *
     * @return UserBuilderInterface
     */
    public function withResetToken(string $resetToken): UserBuilderInterface;

    /**
     * @param string $apiToken
     *
     * @return UserBuilderInterface
     */
    public function withApiToken(string $apiToken): UserBuilderInterface;

    /**
     * @param string $taxesIdentifier
     *
     * @return UserBuilderInterface
     */
    public function withTaxesIdentifier(string $taxesIdentifier): UserBuilderInterface;

    /**
     * @param string $format
     *
     * @return UserBuilderInterface
     */
    public function withFormat(string $format): UserBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return UserBuilderInterface
     */
    public function withImage(ImageInterface $image): UserBuilderInterface;

    /**
     * @param CompanyInterface $company
     *
     * @return UserBuilderInterface
     */
    public function withCompany(CompanyInterface $company): UserBuilderInterface;

    /**
     * @param NotificationInterface $notification
     *
     * @return UserBuilderInterface
     */
    public function withNotification(NotificationInterface $notification): UserBuilderInterface;

    /**
     * @return UserInterface
     */
    public function build(): UserInterface;
}

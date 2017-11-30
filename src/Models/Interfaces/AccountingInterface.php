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
 * Interface AccountingInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface AccountingInterface
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return null|string
     */
    public function getInterlocutor():? string;

    /**
     * @param string $interlocutor
     */
    public function setInterlocutor(string $interlocutor);

    /**
     * @return string|null
     */
    public function getPhoneNumber():? string;

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber);

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     */
    public function setEmail(string $email);

    /**
     * @return string
     */
    public function getAddress(): string;

    /**
     * @param string $address
     */
    public function setAddress(string $address);

    /**
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @param CompanyInterface $company
     */
    public function setCompany(CompanyInterface $company);
}

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

use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\AccountingInterface;

/**
 * Interface AccountingBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface AccountingBuilderInterface
{
    /**
     * @return AccountingBuilderInterface
     */
    public function create(): AccountingBuilderInterface;

    /**
     * @param AccountingInterface $accounting
     *
     * @return AccountingBuilderInterface
     */
    public function setAccounting(AccountingInterface $accounting): AccountingBuilderInterface;

    /**
     * @param string $name
     *
     * @return AccountingBuilderInterface
     */
    public function withName(string $name): AccountingBuilderInterface;

    /**
     * @param string $interlocutor
     *
     * @return AccountingBuilderInterface
     */
    public function withInterlocutor(string $interlocutor): AccountingBuilderInterface;

    /**
     * @param string $phoneNumber
     *
     * @return AccountingBuilderInterface
     */
    public function withPhoneNumber(string $phoneNumber): AccountingBuilderInterface;

    /**
     * @param string $email
     *
     * @return AccountingBuilderInterface
     */
    public function withEmail(string $email): AccountingBuilderInterface;

    /**
     * @param string $address
     *
     * @return AccountingBuilderInterface
     */
    public function withAddress(string $address): AccountingBuilderInterface;

    /**
     * @param CompanyInterface $company
     *
     * @return AccountingBuilderInterface
     */
    public function withCompany(CompanyInterface $company): AccountingBuilderInterface;

    /**
     * @return AccountingInterface
     */
    public function build(): AccountingInterface;
}

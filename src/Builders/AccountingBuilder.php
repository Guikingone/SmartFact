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

namespace App\Builders;

use App\Interactors\AccountingInteractor;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\AccountingInterface;
use App\Builders\Interfaces\AccountingBuilderInterface;

/**
 * Class AccountingBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class AccountingBuilder implements AccountingBuilderInterface
{
    /**
     * @var AccountingInterface
     */
    private $accounting;

    /**
     * {@inheritdoc}
     */
    public function create(): AccountingBuilderInterface
    {
        $this->accounting = new AccountingInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccounting(AccountingInterface $accounting): AccountingBuilderInterface
    {
        $this->accounting = $accounting;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withName(string $name): AccountingBuilderInterface
    {
        $this->accounting->setName($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withInterlocutor(string $interlocutor): AccountingBuilderInterface
    {
        $this->accounting->setInterlocutor($interlocutor);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPhoneNumber(string $phoneNumber): AccountingBuilderInterface
    {
        $this->accounting->setPhoneNumber($phoneNumber);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withEmail(string $email): AccountingBuilderInterface
    {
        $this->accounting->setEmail($email);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withAddress(string $address): AccountingBuilderInterface
    {
        $this->accounting->setAddress($address);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withCompany(CompanyInterface $company): AccountingBuilderInterface
    {
        $this->accounting->setCompany($company);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): AccountingInterface
    {
        return $this->accounting;
    }
}

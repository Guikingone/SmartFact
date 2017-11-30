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
        // TODO: Implement withName() method.
    }

    /**
     * {@inheritdoc}
     */
    public function withInterlocutor(string $interlocutor): AccountingBuilderInterface
    {
        // TODO: Implement withInterlocutor() method.
    }

    /**
     * {@inheritdoc}
     */
    public function withPhoneNumber(string $phoneNumber): AccountingBuilderInterface
    {
        // TODO: Implement withPhoneNumber() method.
    }

    /**
     * {@inheritdoc}
     */
    public function withEmail(string $email): AccountingBuilderInterface
    {
        // TODO: Implement withEmail() method.
    }

    /**
     * {@inheritdoc}
     */
    public function withAddress(string $address): AccountingBuilderInterface
    {
        // TODO: Implement withAddress() method.
    }

    /**
     * {@inheritdoc}
     */
    public function withCompany(CompanyInterface $company): AccountingBuilderInterface
    {
        // TODO: Implement withCompany() method.
    }

    /**
     * {@inheritdoc}
     */
    public function build(): AccountingInterface
    {
        return $this->accounting;
    }
}

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

use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\AccountingInterface;

/**
 * Class Accounting
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Accounting implements AccountingInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $interlocutor;

    /**
     * @var int
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var CompanyInterface
     */
    protected $company;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getInterlocutor():? string
    {
        return $this->interlocutor;
    }

    /**
     * {@inheritdoc}
     */
    public function setInterlocutor(string $interlocutor)
    {
        $this->interlocutor = $interlocutor;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber():? int
    {
        return $this->phoneNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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
    public function getAddress(): string
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
}

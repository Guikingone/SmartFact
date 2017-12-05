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
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\AccountingInterface;

/**
 * Class Company
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Company implements CompanyInterface
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
    protected $legalIdentifier;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $socialAddress;

    /**
     * @var string
     */
    protected $taxesIdentifier;

    /**
     * @var string
     */
    protected $artisanIdentifier;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var ImageInterface
     */
    protected $image;

    /**
     * @var AccountingInterface
     */
    protected $accounting;

    /**
     * @var \ArrayAccess
     */
    protected $bills;

    /**
     * @var \ArrayAccess
     */
    protected $clients;

    /**
     * @var UserInterface
     */
    protected $owner;

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
    public function getLegalIdentifier(): string
    {
        return $this->legalIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function setLegalIdentifier(string $legalIdentifier)
    {
        $this->legalIdentifier = $legalIdentifier;
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
    public function getSocialAddress(): string
    {
        return $this->socialAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function setSocialAddress(string $socialAddress)
    {
        $this->socialAddress = $socialAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxesIdentifier(): string
    {
        return $this->taxesIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxesIdentifier(string $taxesIdentifier)
    {
        $this->taxesIdentifier = $taxesIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getArtisanIdentifier(): ? string
    {
        return $this->artisanIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function setArtisanIdentifier(string $artisanIdentifier)
    {
        $this->artisanIdentifier = $artisanIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * {@inheritdoc}
     */
    public function setFormat(string $format)
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage(): ImageInterface
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
    public function getAccounting(): AccountingInterface
    {
        return $this->accounting;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccounting(AccountingInterface $accounting)
    {
        $this->accounting = $accounting;
    }

    /**
     * {@inheritdoc}
     */
    public function getBills(): \ArrayAccess
    {
        return $this->bills;
    }

    /**
     * {@inheritdoc}
     */
    public function addBill(BillsInterface $bills)
    {
        $this->bills[] = $bills;
    }

    /**
     * {@inheritdoc}
     */
    public function removeBill(BillsInterface $bills)
    {
        unset($this->bills[array_search($bills, (array) $this->bills, true)]);
    }

    /**
     * {@inheritdoc}
     */
    public function getClients(): \ArrayAccess
    {
        return $this->clients;
    }

    /**
     * {@inheritdoc}
     */
    public function addClient(ClientInterface $client)
    {
        $this->clients[] = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function removeClient(ClientInterface $client)
    {
        unset($this->clients[array_search($client, (array) $this->clients, true)]);
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): UserInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(UserInterface $owner): void
    {
        $this->owner = $owner;
    }
}

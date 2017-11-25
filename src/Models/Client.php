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

use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;

/**
 * Class Client
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Client implements ClientInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $legalIdentifier;

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
    protected $address;

    /**
     * @var string
     */
    protected $socialAddress;

    /**
     * @var ImageInterface
     */
    protected $image;

    /**
     * @var \ArrayAccess
     */
    protected $bills;

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
    public function getLegalIdentifier(): int
    {
        return $this->legalIdentifier;
    }

    /**
     * {@inheritdoc}
     */
    public function setLegalIdentifier(int $legalIdentifier)
    {
        $this->legalIdentifier = $legalIdentifier;
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
    public function getArtisanIdentifier():? string
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
    public function removeBill(BillsInterface $bill)
    {
        unset($this->bills[array_search($bill, (array) $this->bills, true)]);
    }
}

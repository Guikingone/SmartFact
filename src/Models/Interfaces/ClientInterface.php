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
 * Interface ClientInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ClientInterface
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
     * @return int
     */
    public function getLegalIdentifier(): int;

    /**
     * @param int $legalIdentifier
     */
    public function setLegalIdentifier(int $legalIdentifier);

    /**
     * @return string
     */
    public function getTaxesIdentifier(): string;

    /**
     * @param string $taxesIdentifier
     */
    public function setTaxesIdentifier(string $taxesIdentifier);

    /**
     * @return null|string
     */
    public function getArtisanIdentifier():? string;

    /**
     * @param string $artisanIdentifier
     */
    public function setArtisanIdentifier(string $artisanIdentifier);

    /**
     * @return string
     */
    public function getFormat(): string;

    /**
     * @param string $format
     */
    public function setFormat(string $format);

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
    public function getAddress(): string;

    /**
     * @param string $address
     */
    public function setAddress(string $address);

    /**
     * @return string
     */
    public function getSocialAddress(): string;

    /**
     * @param string $socialAddress
     */
    public function setSocialAddress(string $socialAddress);

    /**
     * @return ImageInterface
     */
    public function getImage(): ImageInterface;

    /**
     * @param ImageInterface $image
     */
    public function setImage(ImageInterface $image);

    /**
     * @return \ArrayAccess
     */
    public function getBills(): \ArrayAccess;

    /**
     * @param BillsInterface $bills
     */
    public function addBill(BillsInterface $bills);

    /**
     * @param BillsInterface $bill
     */
    public function removeBill(BillsInterface $bill);
}

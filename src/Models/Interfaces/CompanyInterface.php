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
 * Interface CompanyInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface CompanyInterface
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
     * @return string
     */
    public function getLegalIdentifier(): string;

    /**
     * @param string $legalIdentifier
     */
    public function setLegalIdentifier(string $legalIdentifier);

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
     * @return ImageInterface
     */
    public function getImage(): ImageInterface;

    /**
     * @param ImageInterface $image
     */
    public function setImage(ImageInterface $image);

    /**
     * @return AccountingInterface
     */
    public function getAccounting(): AccountingInterface;

    /**
     * @param AccountingInterface $accounting
     */
    public function setAccounting(AccountingInterface $accounting);

    /**
     * @return \ArrayAccess
     */
    public function getBills(): \ArrayAccess;

    /**
     * @param BillsInterface $bills
     */
    public function addBill(BillsInterface $bills);

    /**
     * @param BillsInterface $bills
     */
    public function removeBill(BillsInterface $bills);

    /**
     * @return \ArrayAccess
     */
    public function getClients(): \ArrayAccess;

    /**
     * @param ClientInterface $client
     */
    public function addClient(ClientInterface $client);

    /**
     * @param ClientInterface $client
     */
    public function removeClient(ClientInterface $client);
}

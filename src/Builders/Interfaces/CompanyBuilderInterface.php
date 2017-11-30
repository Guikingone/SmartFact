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

use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\AccountingInterface;

/**
 * Interface CompanyBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface CompanyBuilderInterface
{
    /**
     * @return CompanyBuilderInterface
     */
    public function create(): CompanyBuilderInterface;

    /**
     * @param CompanyInterface $company
     *
     * @return CompanyBuilderInterface
     */
    public function setCompany(CompanyInterface $company): CompanyBuilderInterface;

    /**
     * @param string $name
     *
     * @return CompanyBuilderInterface
     */
    public function withName(string $name): CompanyBuilderInterface;

    /**
     * @param string $legalIdentifier
     *
     * @return CompanyBuilderInterface
     */
    public function withLegalIdentifier(string $legalIdentifier): CompanyBuilderInterface;

    /**
     * @param string $address
     *
     * @return CompanyBuilderInterface
     */
    public function withAddress(string $address): CompanyBuilderInterface;

    /**
     * @param string $socialAddress
     *
     * @return CompanyBuilderInterface
     */
    public function withSocialAddress(string $socialAddress): CompanyBuilderInterface;

    /**
     * @param string $taxesIdentifier
     *
     * @return CompanyBuilderInterface
     */
    public function withTaxesIdentifier(string $taxesIdentifier): CompanyBuilderInterface;

    /**
     * @param string $artisanIdentifier
     *
     * @return CompanyBuilderInterface
     */
    public function withArtisanIdentifier(string $artisanIdentifier): CompanyBuilderInterface;

    /**
     * @param string $format
     *
     * @return CompanyBuilderInterface
     */
    public function withFormat(string $format): CompanyBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return CompanyBuilderInterface
     */
    public function withImage(ImageInterface $image): CompanyBuilderInterface;

    /**
     * @param AccountingInterface $accounting
     *
     * @return CompanyBuilderInterface
     */
    public function withAccounting(AccountingInterface $accounting): CompanyBuilderInterface;

    /**
     * @param BillsInterface $bills
     *
     * @return CompanyBuilderInterface
     */
    public function withBill(BillsInterface $bills): CompanyBuilderInterface;

    /**
     * @param ClientInterface $client
     *
     * @return CompanyBuilderInterface
     */
    public function withClient(ClientInterface $client): CompanyBuilderInterface;

    /**
     * @return CompanyInterface
     */
    public function build(): CompanyInterface;
}

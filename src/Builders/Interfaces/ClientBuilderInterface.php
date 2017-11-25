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

use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;

/**
 * Interface ClientBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ClientBuilderInterface
{
    /**
     * @return ClientBuilderInterface
     */
    public function create(): ClientBuilderInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ClientBuilderInterface
     */
    public function setClient(ClientInterface $client): ClientBuilderInterface;

    /**
     * @param string $name
     *
     * @return ClientBuilderInterface
     */
    public function withName(string $name): ClientBuilderInterface;

    /**
     * @param int $legalIdentifier
     *
     * @return ClientBuilderInterface
     */
    public function withLegalIdentifier(int $legalIdentifier): ClientBuilderInterface;

    /**
     * @param string $taxesIdentifier
     *
     * @return ClientBuilderInterface
     */
    public function withTaxesIdentifier(string $taxesIdentifier): ClientBuilderInterface;

    /**
     * @param string $artisanIdentifier
     *
     * @return ClientBuilderInterface
     */
    public function withArtisanIdentifier(string $artisanIdentifier): ClientBuilderInterface;

    /**
     * @param string $format
     *
     * @return ClientBuilderInterface
     */
    public function withFormat(string $format): ClientBuilderInterface;

    /**
     * @param string $firstName
     *
     * @return ClientBuilderInterface
     */
    public function withFirstName(string $firstName): ClientBuilderInterface;

    /**
     * @param string $lastName
     *
     * @return ClientBuilderInterface
     */
    public function withLastName(string $lastName): ClientBuilderInterface;

    /**
     * @param string $address
     *
     * @return ClientBuilderInterface
     */
    public function withAddress(string $address): ClientBuilderInterface;

    /**
     * @param string $socialAddress
     *
     * @return ClientBuilderInterface
     */
    public function withSocialAddress(string $socialAddress): ClientBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return ClientBuilderInterface
     */
    public function withImage(ImageInterface $image): ClientBuilderInterface;

    /**
     * @param BillsInterface $bill
     *
     * @return ClientBuilderInterface
     */
    public function withBill(BillsInterface $bill): ClientBuilderInterface;

    /**
     * @return ClientInterface
     */
    public function build(): ClientInterface;
}

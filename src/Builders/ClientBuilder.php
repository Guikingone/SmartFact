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

use App\Interactors\ClientInteractor;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;
use App\Builders\Interfaces\ClientBuilderInterface;

/**
 * Class ClientBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ClientBuilder implements ClientBuilderInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function create(): ClientBuilderInterface
    {
        $this->client = new ClientInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setClient(ClientInterface $client): ClientBuilderInterface
    {
        $this->client = $client;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withName(string $name): ClientBuilderInterface
    {
        $this->client->setName($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLegalIdentifier(int $legalIdentifier): ClientBuilderInterface
    {
        $this->client->setLegalIdentifier($legalIdentifier);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTaxesIdentifier(string $taxesIdentifier): ClientBuilderInterface
    {
        $this->client->setTaxesIdentifier($taxesIdentifier);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withArtisanIdentifier(string $artisanIdentifier): ClientBuilderInterface
    {
        $this->client->setArtisanIdentifier($artisanIdentifier);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withFormat(string $format): ClientBuilderInterface
    {
        $this->client->setFormat($format);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withFirstName(string $firstName): ClientBuilderInterface
    {
        $this->client->setFirstName($firstName);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLastName(string $lastName): ClientBuilderInterface
    {
        $this->client->setLastName($lastName);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withAddress(string $address): ClientBuilderInterface
    {
        $this->client->setAddress($address);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withSocialAddress(string $socialAddress): ClientBuilderInterface
    {
        $this->client->setSocialAddress($socialAddress);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withImage(ImageInterface $image): ClientBuilderInterface
    {
        $this->client->setImage($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withBill(BillsInterface $bill): ClientBuilderInterface
    {
        $this->client->addBill($bill);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): ClientInterface
    {
        return $this->client;
    }
}

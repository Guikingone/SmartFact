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

use App\Interactors\CompanyInteractor;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\AccountingInterface;
use App\Builders\Interfaces\CompanyBuilderInterface;
use App\Models\Interfaces\UserInterface;

/**
 * Class CompanyBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CompanyBuilder implements CompanyBuilderInterface
{
    /**
     * @var CompanyInterface
     */
    private $company;

    /**
     * {@inheritdoc}
     */
    public function create(): CompanyBuilderInterface
    {
        $this->company = new CompanyInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCompany(CompanyInterface $company): CompanyBuilderInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withName(string $name): CompanyBuilderInterface
    {
        $this->company->setName($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLegalIdentifier(string $legalIdentifier): CompanyBuilderInterface
    {
        $this->company->setLegalIdentifier($legalIdentifier);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withAddress(string $address): CompanyBuilderInterface
    {
        $this->company->setAddress($address);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withSocialAddress(string $socialAddress): CompanyBuilderInterface
    {
        $this->company->setSocialAddress($socialAddress);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTaxesIdentifier(string $taxesIdentifier): CompanyBuilderInterface
    {
        $this->company->setTaxesIdentifier($taxesIdentifier);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withArtisanIdentifier(string $artisanIdentifier): CompanyBuilderInterface
    {
        $this->company->setArtisanIdentifier($artisanIdentifier);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withFormat(string $format): CompanyBuilderInterface
    {
        $this->company->setFormat($format);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withImage(ImageInterface $image): CompanyBuilderInterface
    {
        $this->company->setImage($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withAccounting(AccountingInterface $accounting): CompanyBuilderInterface
    {
        $this->company->setAccounting($accounting);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withBill(BillsInterface $bills): CompanyBuilderInterface
    {
        $this->company->addBill($bills);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withClient(ClientInterface $client): CompanyBuilderInterface
    {
        $this->company->addClient($client);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withOwner(UserInterface $owner): CompanyBuilderInterface
    {
        $this->company->setOwner($owner);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): CompanyInterface
    {
        return $this->company;
    }
}

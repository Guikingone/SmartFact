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

use App\Interactors\BillsInteractor;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\ProductInterface;
use App\Builders\Interfaces\BillsBuilderInterface;

/**
 * Class BillsBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BillsBuilder implements BillsBuilderInterface
{
    /**
     * @var BillsInterface
     */
    private $bills;

    /**
     * {@inheritdoc}
     */
    public function create(): BillsBuilderInterface
    {
        $this->bills = new BillsInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setBill(BillsInterface $bill): BillsBuilderInterface
    {
        $this->bills = $bill;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUuid(string $uuid): BillsBuilderInterface
    {
        $this->bills->setUuid($uuid);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withCreationDate(\DateTime $creationDate): BillsBuilderInterface
    {
        $this->bills->setCreationDate($creationDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withProductionDate(\DateTime $productionDate): BillsBuilderInterface
    {
        $this->bills->setProductionDate($productionDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withModificationDate(\DateTime $modificationDate): BillsBuilderInterface
    {
        $this->bills->setModificationDate($modificationDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTaxesFreeTotal(float $taxesFreeTotal): BillsBuilderInterface
    {
        $this->bills->setTaxesFreeTotal($taxesFreeTotal);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTaxesTotal(float $taxesTotal): BillsBuilderInterface
    {
        $this->bills->setTaxesTotal($taxesTotal);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTaxes(bool $taxes): BillsBuilderInterface
    {
        $this->bills->setTaxes($taxes);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTaxesPercentage(float $taxesPercentage): BillsBuilderInterface
    {
        $this->bills->setTaxesPercentage($taxesPercentage);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withReduction(bool $reduction): BillsBuilderInterface
    {
        $this->bills->setReduction($reduction);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withReductionTotal(float $redutionTotal): BillsBuilderInterface
    {
        $this->bills->setReductionTotal($redutionTotal);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withSend(bool $send): BillsBuilderInterface
    {
        $this->bills->setSend($send);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withSendingDate(\DateTime $sendingDate): BillsBuilderInterface
    {
        $this->bills->setSendingDate($sendingDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLimitPaymentDate(\DateTime $limitPaymentDate): BillsBuilderInterface
    {
        $this->bills->setLimitPaymentDate($limitPaymentDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPenaltyRate(float $penaltyRate): BillsBuilderInterface
    {
        $this->bills->setPenaltyRate($penaltyRate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withRecoveryPrice(float $recoveryPrice): BillsBuilderInterface
    {
        $this->bills->setRecoveryPrice($recoveryPrice);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withFile(string $file): BillsBuilderInterface
    {
        $this->bills->setFile($file);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withFinalFile(\SplFileInfo $finalFile): BillsBuilderInterface
    {
        $this->bills->setFinalFile($finalFile);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withOwner(CompanyInterface $owner): BillsBuilderInterface
    {
        $this->bills->setOwner($owner);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withClient(ClientInterface $client): BillsBuilderInterface
    {
        $this->bills->setClient($client);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withProduct(ProductInterface $product): BillsBuilderInterface
    {
        $this->bills->addProduct($product);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): BillsInterface
    {
        return $this->bills;
    }
}

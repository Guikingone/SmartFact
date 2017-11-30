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
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\ProductInterface;

/**
 * Interface BillsBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface BillsBuilderInterface
{
    /**
     * @return BillsBuilderInterface
     */
    public function create(): BillsBuilderInterface;

    /**
     * @param BillsInterface $bill
     *
     * @return BillsBuilderInterface
     */
    public function setBill(BillsInterface $bill): BillsBuilderInterface;

    /**
     * @param string $uuid
     *
     * @return BillsBuilderInterface
     */
    public function withUuid(string $uuid): BillsBuilderInterface;

    /**
     * @param \DateTime $creationDate    The creation date of the Bills.
     *
     * @return BillsBuilderInterface
     */
    public function withCreationDate(\DateTime $creationDate): BillsBuilderInterface;

    /**
     * @param \DateTime $productionDate    The production date of the Bills.
     *
     * @return BillsBuilderInterface
     */
    public function withProductionDate(\DateTime $productionDate): BillsBuilderInterface;

    /**
     * @param \DateTime $modificationDate    The modification date of the Bills.
     *
     * @return BillsBuilderInterface
     */
    public function withModificationDate(\DateTime $modificationDate): BillsBuilderInterface;

    /**
     * @param float $taxesFreeTotal
     *
     * @return BillsBuilderInterface
     */
    public function withTaxesFreeTotal(float $taxesFreeTotal): BillsBuilderInterface;

    /**
     * @param float $taxesTotal
     *
     * @return BillsBuilderInterface
     */
    public function withTaxesTotal(float $taxesTotal): BillsBuilderInterface;

    /**
     * @param bool $taxes
     *
     * @return BillsBuilderInterface
     */
    public function withTaxes(bool $taxes): BillsBuilderInterface;

    /**
     * @param float $taxesPercentage
     *
     * @return BillsBuilderInterface
     */
    public function withTaxesPercentage(float $taxesPercentage): BillsBuilderInterface;

    /**
     * @param bool $reduction
     *
     * @return BillsBuilderInterface
     */
    public function withReduction(bool $reduction): BillsBuilderInterface;

    /**
     * @param float $redutionTotal
     *
     * @return BillsBuilderInterface
     */
    public function withReductionTotal(float $redutionTotal): BillsBuilderInterface;

    /**
     * @param bool $send
     *
     * @return BillsBuilderInterface
     */
    public function withSend(bool $send): BillsBuilderInterface;

    /**
     * @param \DateTime $sendingDate
     *
     * @return BillsBuilderInterface
     */
    public function withSendingDate(\DateTime $sendingDate): BillsBuilderInterface;

    /**
     * @param \DateTime $limitPaymentDate
     *
     * @return BillsBuilderInterface
     */
    public function withLimitPaymentDate(\DateTime $limitPaymentDate): BillsBuilderInterface;

    /**
     * @param float $penaltyRate
     *
     * @return BillsBuilderInterface
     */
    public function withPenaltyRate(float $penaltyRate): BillsBuilderInterface;

    /**
     * @param float $recoveryPrice
     *
     * @return BillsBuilderInterface
     */
    public function withRecoveryPrice(float $recoveryPrice): BillsBuilderInterface;

    /**
     * @param string $file
     *
     * @return BillsBuilderInterface
     */
    public function withFile(string $file): BillsBuilderInterface;

    /**
     * @param \SplFileInfo $finalFile
     *
     * @return BillsBuilderInterface
     */
    public function withFinalFile(\SplFileInfo $finalFile): BillsBuilderInterface;

    /**
     * @param CompanyInterface $owner
     *
     * @return BillsBuilderInterface
     */
    public function withOwner(CompanyInterface $owner): BillsBuilderInterface;

    /**
     * @param ClientInterface $client
     *
     * @return BillsBuilderInterface
     */
    public function withClient(ClientInterface $client): BillsBuilderInterface;

    /**
     * @param ProductInterface $product
     *
     * @return BillsBuilderInterface
     */
    public function withProduct(ProductInterface $product): BillsBuilderInterface;

    /**
     * @return BillsInterface
     */
    public function build(): BillsInterface;
}

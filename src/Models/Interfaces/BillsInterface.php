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
 * Interface BillsInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface BillsInterface
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return int
     */
    public function getUuid(): int;

    /**
     * @param int $uuid
     */
    public function setUuid(int $uuid);

    /**
     * @return string
     */
    public function getCreationDate(): string;

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate);

    /**
     * @return null|string
     */
    public function getProductionDate():? string;

    /**
     * @param \DateTime $productionDate
     */
    public function setProductionDate(\DateTime $productionDate);

    /**
     * @return null|string
     */
    public function getModificationDate():? string;

    /**
     * @param \DateTime $modificationDate
     */
    public function setModificationDate(\DateTime $modificationDate);

    /**
     * @return float
     */
    public function getTaxesFreeTotal(): float;

    /**
     * @param float $taxesFreeTotal
     */
    public function setTaxesFreeTotal(float $taxesFreeTotal);

    /**
     * @return float|null
     */
    public function getTaxesTotal():? float;

    /**
     * @param float $taxesTotal
     */
    public function setTaxesTotal(float $taxesTotal);

    /**
     * @return bool
     */
    public function canAddTaxes(): bool;

    /**
     * @param bool $taxes
     */
    public function setTaxes(bool $taxes);

    /**
     * @return float|null
     */
    public function taxesPercentage():? float;

    /**
     * @param float $taxesPercentage
     */
    public function setTaxesPercentage(float $taxesPercentage);

    /**
     * @return bool
     */
    public function canHaveReduction(): bool;

    /**
     * @param bool $reduction
     */
    public function setReduction(bool $reduction);

    /**
     * @return float|null
     */
    public function getReductionTotal():? float;

    /**
     * @param int $reductionTotal
     */
    public function setReductionTotal(int $reductionTotal);

    /**
     * @return bool
     */
    public function hasBeenSend(): bool;

    /**
     * @param bool $send
     */
    public function setSend(bool $send);

    /**
     * @return string
     */
    public function getSendingDate(): string;

    /**
     * @param \DateTime $sendingDate
     */
    public function setSendingDate(\DateTime $sendingDate);

    /**
     * @return string
     */
    public function getLimitPaymentDate(): string;

    /**
     * @param \DateTime $limitPaymentDate
     */
    public function setLimitPaymentDate(\DateTime $limitPaymentDate);

    /**
     * @return float|null
     */
    public function getPenaltyRate():? float;

    /**
     * @param float $penaltyRate
     */
    public function setPenaltyRate(float $penaltyRate);

    /**
     * @return float
     */
    public function getRecoveryPrice(): float;

    /**
     * @param float $recoveryPrice
     */
    public function setRecoveryPrice(float $recoveryPrice);

    /**
     * @return string
     */
    public function getFile(): string;

    /**
     * @param string $file
     */
    public function setFile(string $file);

    /**
     * @return UserInterface
     */
    public function getAuthor(): UserInterface;

    /**
     * @param UserInterface $author
     */
    public function setAuthor(UserInterface $author);

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client);
}

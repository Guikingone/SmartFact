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

use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\ProductInterface;

/**
 * Class Bills
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Bills implements BillsInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var \DateTime
     */
    protected $productionDate;

    /**
     * @var \DateTime
     */
    protected $modificationDate;

    /**
     * @var float
     */
    protected $taxesFreeTotal;

    /**
     * @var float
     */
    protected $taxesTotal;

    /**
     * @var bool
     */
    protected $taxes;

    /**
     * @var float
     */
    protected $taxesPercentage;

    /**
     * @var bool
     */
    protected $reduction;

    /**
     * @var float
     */
    protected $reductionTotal;

    /**
     * @var bool
     */
    protected $send;

    /**
     * @var \DateTime
     */
    protected $sendingDate;

    /**
     * @var \DateTime
     */
    protected $limitPaymentDate;

    /**
     * @var float
     */
    protected $penaltyRate;

    /**
     * @var float
     */
    protected $recoveryPrice;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var \SplFileInfo
     */
    protected $finalFile;

    /**
     * @var CompanyInterface
     */
    protected $owner;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var \ArrayAccess
     */
    protected $products;

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
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * {@inheritdoc}
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreationDate(): string
    {
        return $this->creationDate->format("D d-M-Y H:i:s");
    }

    /**
     * {@inheritdoc}
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductionDate():? string
    {
        return $this->productionDate->format('D d-M-Y H:i:s');
    }

    public function setProductionDate(\DateTime $productionDate)
    {
        $this->productionDate = $productionDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getModificationDate():? string
    {
        return $this->modificationDate->format('D d-M-Y H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setModificationDate(\DateTime $modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxesFreeTotal(): float
    {
        return $this->taxesFreeTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxesFreeTotal(float $taxesFreeTotal)
    {
        $this->taxesFreeTotal = $taxesFreeTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxesTotal():? float
    {
        return $this->taxesTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxesTotal(float $taxesTotal)
    {
        $this->taxesTotal = $taxesTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function canAddTaxes(): bool
    {
        return $this->taxes;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxes(bool $taxes)
    {
        $this->taxes = $taxes;
    }

    /**
     * {@inheritdoc}
     */
    public function taxesPercentage():? float
    {
        return $this->taxesPercentage;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxesPercentage(float $taxesPercentage)
    {
        $this->taxesPercentage = $taxesPercentage;
    }

    /**
     * {@inheritdoc}
     */
    public function canHaveReduction(): bool
    {
        return $this->reduction;
    }

    /**
     * {@inheritdoc}
     */
    public function setReduction(bool $reduction)
    {
        $this->reduction = $reduction;
    }

    /**
     * {@inheritdoc}
     */
    public function getReductionTotal():? float
    {
        return $this->reductionTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function setReductionTotal(float $reductionTotal)
    {
        $this->reductionTotal = $reductionTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function hasBeenSend(): bool
    {
        return $this->send;
    }

    /**
     * {@inheritdoc}
     */
    public function setSend(bool $send)
    {
        $this->send = $send;
    }

    /**
     * {@inheritdoc}
     */
    public function getSendingDate(): string
    {
        return $this->sendingDate->format('D d-M-Y H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setSendingDate(\DateTime $sendingDate)
    {
        $this->sendingDate = $sendingDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getLimitPaymentDate(): string
    {
        return $this->limitPaymentDate->format('D d-M-Y H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setLimitPaymentDate(\DateTime $limitPaymentDate)
    {
        $this->limitPaymentDate = $limitPaymentDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getPenaltyRate():? float
    {
        return $this->penaltyRate;
    }

    /**
     * {@inheritdoc}
     */
    public function setPenaltyRate(float $penaltyRate)
    {
        $this->penaltyRate = $penaltyRate;
    }

    /**
     * {@inheritdoc}
     */
    public function getRecoveryPrice(): float
    {
        return $this->recoveryPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function setRecoveryPrice(float $recoveryPrice)
    {
        $this->recoveryPrice = $recoveryPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function setFile(string $file)
    {
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function getFinalFile(): \SplFileInfo
    {
        return $this->finalFile;
    }

    /**
     * {@inheritdoc}
     */
    public function setFinalFile(\SplFileInfo $finalFile)
    {
        $this->finalFile = $finalFile;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): CompanyInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(CompanyInterface $owner)
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * {@inheritdoc}
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts(): \ArrayAccess
    {
        return $this->products;
    }

    /**
     * {@inheritdoc}
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function removeProduct(ProductInterface $product)
    {
        unset($this->products[array_search($product, (array) $this->products, true)]);
    }
}

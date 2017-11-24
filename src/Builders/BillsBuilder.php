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
    public function withUuid(int $uuid): BillsBuilderInterface
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
    public function build(): BillsInterface
    {
        return $this->bills;
    }
}

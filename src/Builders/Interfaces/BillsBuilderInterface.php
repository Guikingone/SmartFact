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
     * @param int $uuid                  The unique identifier of the Bills.
     *
     * @return BillsBuilderInterface
     */
    public function withUuid(int $uuid): BillsBuilderInterface;

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
     * @return BillsInterface
     */
    public function build(): BillsInterface;
}

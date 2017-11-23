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
 * Interface ProductInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ProductInterface
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     */
    public function setType(string $type);

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $price
     */
    public function setPrice(float $price);

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity);

    /**
     * @return BillsInterface
     */
    public function getBill(): BillsInterface;

    /**
     * @param BillsInterface $bill
     */
    public function setBill(BillsInterface $bill);
}

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
use App\Models\Interfaces\ProductInterface;

/**
 * Interface ProductBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ProductBuilderInterface
{
    /**
     * @return ProductBuilderInterface
     */
    public function create(): ProductBuilderInterface;

    /**
     * @param ProductInterface $product    The Product to define as class instance.
     *
     * @return ProductBuilderInterface
     */
    public function setProduct(ProductInterface $product): ProductBuilderInterface;

    /**
     * @param string $type                The product type.
     *
     * @return ProductBuilderInterface
     */
    public function withType(string $type): ProductBuilderInterface;

    /**
     * @param float $price                The product price.
     *
     * @return ProductBuilderInterface
     */
    public function withPrice(float $price): ProductBuilderInterface;

    /**
     * @param int $quantity               The product quantity.
     *
     * @return ProductBuilderInterface
     */
    public function withQuantity(int $quantity): ProductBuilderInterface;

    /**
     * @param BillsInterface $bills       The bill which contain the product.
     *
     * @return ProductBuilderInterface
     */
    public function withBill(BillsInterface $bills): ProductBuilderInterface;

    /**
     * @return ProductInterface
     */
    public function build(): ProductInterface;
}

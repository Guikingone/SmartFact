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

use App\Interactors\ProductInteractor;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ProductInterface;
use App\Builders\Interfaces\ProductBuilderInterface;

/**
 * Class ProductBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ProductBuilder implements ProductBuilderInterface
{
    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * {@inheritdoc}
     */
    public function create(): ProductBuilderInterface
    {
        $this->product = new ProductInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withType(string $type): ProductBuilderInterface
    {
        $this->product->setType($type);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPrice(float $price): ProductBuilderInterface
    {
        $this->product->setPrice($price);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withQuantity(int $quantity): ProductBuilderInterface
    {
        $this->product->setQuantity($quantity);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withBill(BillsInterface $bills): ProductBuilderInterface
    {
        $this->product->setBill($bills);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): ProductInterface
    {
        return $this->product;
    }
}

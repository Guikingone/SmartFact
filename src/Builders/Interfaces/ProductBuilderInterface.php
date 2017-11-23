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
     * @param string $type               The product type.
     *
     * @return ProductBuilderInterface
     */
    public function withType(string $type): ProductBuilderInterface;

    /**
     * @return ProductInterface
     */
    public function build(): ProductInterface;
}

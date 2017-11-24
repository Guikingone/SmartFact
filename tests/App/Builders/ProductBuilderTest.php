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

use PHPUnit\Framework\TestCase;

/**
 * Class ProductBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ProductBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new ProductBuilder();

        $builder
            ->create()
            ->withType('Gestion de Projet')
            ->withPrice(35.24)
            ->withQuantity(200)
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals(35.24, $builder->build()->getPrice());
        static::assertEquals(200, $builder->build()->getQuantity());
    }
}

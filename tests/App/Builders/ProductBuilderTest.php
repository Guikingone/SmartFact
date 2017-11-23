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
        ;

        static::assertNull($builder->build()->getId());
    }
}

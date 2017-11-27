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
use App\Interactors\BillsInteractor;
use App\Interactors\ProductInteractor;

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
        static::assertEquals('Gestion de Projet', $builder->build()->getType());
        static::assertEquals(35.24, $builder->build()->getPrice());
        static::assertEquals(200, $builder->build()->getQuantity());
    }

    public function testSetter()
    {
        $builder = new ProductBuilder();

        $productStub = $this->createMock(ProductInteractor::class);
        $productStub->method('getId')
                    ->willReturn(0);

        $builder
            ->setProduct($productStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testRelationWithBill()
    {
        $builder = new ProductBuilder();

        $billStub = $this->createMock(BillsInteractor::class);
        $billStub->method('getId')
                 ->willReturn(0);

        $builder
            ->create()
            ->withType('Gestion de Projet')
            ->withPrice(35.24)
            ->withQuantity(200)
            ->withBill($billStub)
        ;

        static::assertEquals(0, $builder->build()->getBill()->getId());
    }
}

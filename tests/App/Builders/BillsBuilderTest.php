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
use App\Models\Interfaces\BillsInterface;

/**
 * Class BillsBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BillsBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new BillsBuilder();

        $builder
            ->create()
            ->withUuid('FR2017-05-24-01')
            ->withCreationDate(new \DateTime('2017-03-12'))
            ->withProductionDate(new \DateTime("2017-04-12"))
            ->withModificationDate(new \DateTime('2017-04-12'))
            ->withTaxesFreeTotal(2000.45)
            ->withTaxes(true)
            ->withTaxesPercentage(20)
            ->withReductionTotal(0.0)
            ->withReduction(false)
            ->withSend(true)
            ->withSendingDate(new \DateTime('2017-04-12'))
            ->withLimitPaymentDate(new \DateTime('2017-05-12'))
            ->withPenaltyRate(0.0)
            ->withRecoveryPrice(40)
            ->withFile('/public/files/bills/FR217-05-24-01.pdf')
            ->withFinalFile(new \SplFileInfo('FR217-05-24-01.pdf'))
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('FR2017-05-24-01', $builder->build()->getUuid());
        static::assertNull($builder->build()->getId());
        static::assertNull($builder->build()->getId());
        static::assertNull($builder->build()->getId());
        static::assertEquals(2000.45, $builder->build()->getTaxesFreeTotal());
        static::assertNull($builder->build()->getTaxesTotal());
        static::assertTrue($builder->build()->canAddTaxes());
        static::assertEquals(20, $builder->build()->taxesPercentage());
        static::assertEquals(0.0, $builder->build()->getReductionTotal());
        static::assertFalse($builder->build()->canHaveReduction());
        static::assertTrue($builder->build()->hasBeenSend());
        static::assertNull($builder->build()->getId());
        static::assertEquals(0.0, $builder->build()->getPenaltyRate());
        static::assertEquals(40, $builder->build()->getRecoveryPrice());
        static::assertEquals('/public/files/bills/FR217-05-24-01.pdf', $builder->build()->getFile());
        static::assertEquals('FR217-05-24-01.pdf', $builder->build()->getFinalFile());
    }

    public function testSetter()
    {
        $builder = new BillsBuilder();

        $billStub = $this->createMock(BillsInterface::class);
        $billStub->method('getId')
                 ->willReturn(0);

        $builder
            ->setBill($billStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testRelationWithOwner()
    {
        $builder = new BillsBuilder();

        $builder
            ->create()
            ->withUuid('FR2017-05-24-01')
            ->withCreationDate(new \DateTime('2017-03-12'))
            ->withProductionDate(new \DateTime("2017-04-12"))
            ->withModificationDate(new \DateTime('2017-04-12'))
            ->withTaxesFreeTotal(2000.45)
            ->withTaxes(true)
            ->withTaxesPercentage(20)
            ->withReductionTotal(0.0)
            ->withReduction(false)
            ->withSend(true)
            ->withSendingDate(new \DateTime('2017-04-12'))
            ->withLimitPaymentDate(new \DateTime('2017-05-12'))
            ->withPenaltyRate(0.0)
            ->withRecoveryPrice(40)
            ->withFile('/public/files/bills/FR217-05-24-01.pdf')
            ->withFinalFile(new \SplFileInfo('FR217-05-24-01.pdf'))
        ;
    }

    public function testRelationWithClient()
    {

    }

    public function testRelationWithProducts()
    {

    }
}

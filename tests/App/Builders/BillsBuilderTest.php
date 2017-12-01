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
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\ProductInterface;

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
            ->withTaxesTotal(2400.54)
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
        static::assertEquals('Sun 12-Mar-2017 00:00:00', $builder->build()->getCreationDate());
        static::assertEquals('Wed 12-Apr-2017 00:00:00', $builder->build()->getProductionDate());
        static::assertEquals('Wed 12-Apr-2017 00:00:00', $builder->build()->getModificationDate());
        static::assertEquals(2000.45, $builder->build()->getTaxesFreeTotal());
        static::assertEquals(2400.54, $builder->build()->getTaxesTotal());
        static::assertTrue($builder->build()->canAddTaxes());
        static::assertEquals(20, $builder->build()->taxesPercentage());
        static::assertEquals(0.0, $builder->build()->getReductionTotal());
        static::assertFalse($builder->build()->canHaveReduction());
        static::assertTrue($builder->build()->hasBeenSend());
        static::assertEquals('Wed 12-Apr-2017 00:00:00', $builder->build()->getSendingDate());
        static::assertEquals('Fri 12-May-2017 00:00:00', $builder->build()->getLimitPaymentDate());
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

        $ownerStub = $this->createMock(CompanyInterface::class);
        $ownerStub->method('getId')
                  ->willReturn(0);

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
            ->withOwner($ownerStub)
        ;

        static::assertEquals(0, $builder->build()->getOwner()->getId());
    }

    public function testRelationWithClient()
    {
        $builder = new BillsBuilder();

        $clientStub = $this->createMock(ClientInterface::class);
        $clientStub->method('getId')
                   ->willReturn(0);

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
            ->withClient($clientStub)
        ;

        static::assertEquals(0, $builder->build()->getClient()->getId());
    }

    public function testRelationWithProducts()
    {
        $builder = new BillsBuilder();

        $productStub = $this->createMock(ProductInterface::class);
        $productStub->method('getId')
                    ->willReturn(0);

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
            ->withProduct($productStub)
        ;

        static::assertEquals(0, $builder->build()->getProducts()->offsetGet(0)->getId());

        $builder->build()->removeProduct($productStub);

        static::assertEmpty($builder->build()->getProducts());
    }
}

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
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\AccountingInterface;

/**
 * Class CompanyBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CompanyBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new CompanyBuilder();

        $builder
            ->create()
            ->withName('NewCompany')
            ->withLegalIdentifier('12345678900075')
            ->withAddress('404 Road Not Found')
            ->withSocialAddress('404 Road Not Found')
            ->withTaxesIdentifier('FR123456789')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('NewCompany', $builder->build()->getName());
        static::assertEquals('12345678900075', $builder->build()->getLegalIdentifier());
        static::assertEquals('404 Road Not Found', $builder->build()->getAddress());
        static::assertEquals('404 Road Not Found', $builder->build()->getSocialAddress());
        static::assertEquals('FR123456789', $builder->build()->getTaxesIdentifier());
        static::assertEquals('', $builder->build()->getArtisanIdentifier());
        static::assertEquals('SAS', $builder->build()->getFormat());
    }

    public function testSetter()
    {
        $builder = new CompanyBuilder();

        $companyStub = $this->createMock(CompanyInterface::class);
        $companyStub->method('getId')
                    ->willReturn(0);

        $builder
            ->setCompany($companyStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testRelationWithImage()
    {
        $builder = new CompanyBuilder();

        $imageStub = $this->createMock(ImageInterface::class);
        $imageStub->method('getId')
                  ->willReturn(0);

        $builder
            ->create()
            ->withName('NewCompany')
            ->withLegalIdentifier('12345678900075')
            ->withAddress('404 Road Not Found')
            ->withSocialAddress('404 Road Not Found')
            ->withTaxesIdentifier('FR123456789')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withImage($imageStub)
        ;

        static::assertEquals(0, $builder->build()->getImage()->getId());
    }

    public function testRelationWithAccounting()
    {
        $builder = new CompanyBuilder();

        $accountingStub = $this->createMock(AccountingInterface::class);
        $accountingStub->method('getId')
                       ->willReturn(0);

        $builder
            ->create()
            ->withName('NewCompany')
            ->withLegalIdentifier('12345678900075')
            ->withAddress('404 Road Not Found')
            ->withSocialAddress('404 Road Not Found')
            ->withTaxesIdentifier('FR123456789')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withAccounting($accountingStub)
        ;

        static::assertEquals(0, $builder->build()->getAccounting()->getId());
    }

    public function testRelationWithBill()
    {
        $builder = new CompanyBuilder();

        $billStub = $this->createMock(BillsInterface::class);
        $billStub->method('getId')
                 ->willReturn(0);

        $builder
            ->create()
            ->withName('NewCompany')
            ->withLegalIdentifier('12345678900075')
            ->withAddress('404 Road Not Found')
            ->withSocialAddress('404 Road Not Found')
            ->withTaxesIdentifier('FR123456789')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withBill($billStub)
        ;

        static::assertEquals(0, $builder->build()->getBills()->offsetGet(0)->getId());

        $builder->build()->removeBill($billStub);

        static::assertEmpty($builder->build()->getBills());
    }

    public function testRelationWithClient()
    {
        $builder = new CompanyBuilder();

        $clientStub = $this->createMock(ClientInterface::class);
        $clientStub->method('getId')
                   ->willReturn(0);

        $builder
            ->create()
            ->withName('NewCompany')
            ->withLegalIdentifier('12345678900075')
            ->withAddress('404 Road Not Found')
            ->withSocialAddress('404 Road Not Found')
            ->withTaxesIdentifier('FR123456789')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withClient($clientStub)
        ;

        static::assertEquals(0, $builder->build()->getClients()->offsetGet(0)->getId());

        $builder->build()->removeClient($clientStub);

        static::assertEmpty($builder->build()->getClients());
    }

    public function testRelationWithOwner()
    {
        $builder = new CompanyBuilder();

        $ownerStub = $this->createMock(UserInterface::class);
        $ownerStub->method('getId')
                  ->willReturn(0);

        $builder
            ->create()
            ->withName('NewCompany')
            ->withLegalIdentifier('12345678900075')
            ->withAddress('404 Road Not Found')
            ->withSocialAddress('404 Road Not Found')
            ->withTaxesIdentifier('FR123456789')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withOwner($ownerStub)
        ;

        static::assertEquals(0, $builder->build()->getOwner()->getId());
    }
}

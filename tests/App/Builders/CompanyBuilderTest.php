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
use App\Models\Interfaces\CompanyInterface;

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

    }
}

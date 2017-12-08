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
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\BillsInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;

/**
 * Class ClientBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ClientBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new ClientBuilder();

        $builder
            ->create()
            ->withName('NewClient')
            ->withFirstName("New")
            ->withLastName("Client")
            ->withLegalIdentifier(43712404562145)
            ->withTaxesIdentifier('FR012345678987')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withAddress('404 Route de l\'inconnu')
            ->withSocialAddress('404 Route de l\'inconnu')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('NewClient', $builder->build()->getName());
        static::assertEquals("New", $builder->build()->getFirstName());
        static::assertEquals("Client", $builder->build()->getLastName());
        static::assertEquals(43712404562145, $builder->build()->getLegalIdentifier());
        static::assertEquals('FR012345678987', $builder->build()->getTaxesIdentifier());
        static::assertEquals('', $builder->build()->getArtisanIdentifier());
        static::assertEquals('SAS', $builder->build()->getFormat());
        static::assertEquals('404 Route de l\'inconnu', $builder->build()->getAddress());
        static::assertEquals('404 Route de l\'inconnu', $builder->build()->getSocialAddress());
    }

    public function testSetter()
    {
        $builder = new ClientBuilder();

        $clientStub = $this->createMock(ClientInterface::class);
        $clientStub->method('getId')
                    ->willReturn(0);

        $builder
            ->setClient($clientStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testRelationWithImage()
    {
        $builder = new ClientBuilder();

        $image = $this->createMock(ImageInterface::class);
        $image->method('getId')
              ->willReturn(0);

        $builder
            ->create()
            ->withName('NewClient')
            ->withFirstName("New")
            ->withLastName("Client")
            ->withLegalIdentifier(43712404562145)
            ->withImage($image);
        ;

        static::assertEquals(0, $builder->build()->getImage()->getId());
    }

    public function testRelationWithBill()
    {
        $builder = new ClientBuilder();

        $billStub = $this->createMock(BillsInterface::class);
        $billStub->method('getId')
                 ->willReturn(0);

        $builder
            ->create()
            ->withName('NewClient')
            ->withFirstName("New")
            ->withLastName("Client")
            ->withLegalIdentifier(43712404562145)
            ->withTaxesIdentifier('FR012345678987')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withAddress('404 Route de l\'inconnu')
            ->withSocialAddress('404 Route de l\'inconnu')
            ->withBill($billStub)
        ;

        static::assertEquals(0, $builder->build()->getBills()->offsetGet(0)->getId());

        $builder->build()->removeBill($billStub);

        static::assertEmpty($builder->build()->getBills());
    }

    public function testRelationWithRecipient()
    {
        $builder = new ClientBuilder();

        $recipientStub = $this->createMock(CompanyInterface::class);
        $recipientStub->method('getId')
                      ->willReturn(0);

        $builder
            ->create()
            ->withName('NewClient')
            ->withFirstName("New")
            ->withLastName("Client")
            ->withLegalIdentifier(43712404562145)
            ->withTaxesIdentifier('FR012345678987')
            ->withArtisanIdentifier('')
            ->withFormat('SAS')
            ->withAddress('404 Route de l\'inconnu')
            ->withSocialAddress('404 Route de l\'inconnu')
            ->withRecipient($recipientStub)
        ;

        static::assertEquals(0, $builder->build()->getRecipient()->getId());
    }
}

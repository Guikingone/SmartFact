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
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('NewClient', $builder->build()->getName());
        static::assertEquals("New", $builder->build()->getFirstName());
        static::assertEquals("Client", $builder->build()->getLastName());
        static::assertEquals(43712404562145, $builder->build()->getLegalIdentifier());
    }

    public function testRelationWithImage()
    {
        $builder = new ClientBuilder();

        $image = $this->createMock(Image::class);
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
}

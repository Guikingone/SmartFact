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
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;

/**
 * Class ImageBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new ImageBuilder();

        $builder
            ->create()
            ->withName('NewImage')
            ->withExtension('.png')
            ->withSize('25Ko')
            ->withUploadDate(new \DateTime('2017-03-15'))
            ->withModificationDate(new \DateTime('2017-03-16'))
            ->withLocalPath('/public/images/NewImage.png')
            ->withPublicPath('http://domain.extension/public/images/NewImage.png')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('NewImage', $builder->build()->getName());
        static::assertEquals('.png', $builder->build()->getExtension());
        static::assertEquals('25Ko', $builder->build()->getSize());
        static::assertEquals('Wed 15-Mar-2017 00:00:00', $builder->build()->getUploadDate());
        static::assertEquals('Thu 16-Mar-2017 00:00:00', $builder->build()->getModificationDate());
        static::assertEquals('/public/images/NewImage.png', $builder->build()->getLocalPath());
        static::assertEquals('http://domain.extension/public/images/NewImage.png', $builder->build()->getPublicPath());
    }

    public function testSetter()
    {
        $builder = new ImageBuilder();

        $imageStub = $this->createMock(ImageInterface::class);
        $imageStub->method('getId')
                 ->willReturn(0);

        $builder
            ->setImage($imageStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testUserRelation()
    {
        $builder = new ImageBuilder();

        $userMock = $this->createMock(UserInterface::class);
        $userMock->method('getId')
                 ->willReturn(0);

        $builder
            ->create()
            ->withName('NewImage')
            ->withExtension('.png')
            ->withSize('25Ko')
            ->withUploadDate(new \DateTime('2017-03-15'))
            ->withLocalPath('/public/images/NewImage.png')
            ->withPublicPath('http://domain.extension/public/images/NewImage.png')
            ->withUser($userMock);
        ;

        static::assertEquals(0, $builder->build()->getUser()->getId());
    }

    public function testClientRelation()
    {
        $builder = new ImageBuilder();

        $clientMock = $this->createMock(ClientInterface::class);
        $clientMock->method('getId')
                   ->willReturn(0);

        $builder
            ->create()
            ->withName('NewImage')
            ->withExtension('.png')
            ->withSize('25Ko')
            ->withUploadDate(new \DateTime('2017-03-15'))
            ->withLocalPath('/public/images/NewImage.png')
            ->withPublicPath('http://domain.extension/public/images/NewImage.png')
            ->withClient($clientMock);
        ;

        static::assertEquals(0, $builder->build()->getClient()->getId());
    }

    public function testRelationWithCompany()
    {
        $builder = new ImageBuilder();

        $companyStub = $this->createMock(CompanyInterface::class);
        $companyStub->method('getId')
                    ->willReturn(0);

        $builder
            ->create()
            ->withCompany($companyStub)
        ;

        static::assertEquals(0, $builder->build()->getCompany()->getId());
    }
}

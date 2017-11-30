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
use App\Models\Interfaces\CompanyInterface;
use App\Models\Interfaces\NotificationInterface;

/**
 * Class UserBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new UserBuilder();

        $builder
            ->create()
            ->withFirstName('Toto')
            ->withLastName('Toto')
            ->withUsername('Toto')
            ->withEmail('toto@gmail.com')
            ->withPlainPassword('Ie1FDLTOTO')
            ->withPassword('Ie1FDLTOTO')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime("2017-03-12"))
            ->withValidationDate(new \DateTime('2017-03-21'))
            ->withValidationToken('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6')
            ->withValidated(true)
            ->withActive(true)
            ->withResetToken('24ad4a8zd4d1a464a2dz')
            ->withApiToken('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('Toto', $builder->build()->getFirstName());
        static::assertEquals('Toto', $builder->build()->getLastName());
        static::assertEquals('Toto', $builder->build()->getUsername());
        static::assertEquals('toto@gmail.com', $builder->build()->getEmail());
        static::assertEquals('Ie1FDLTOTO', $builder->build()->getPlainPassword());
        static::assertEquals('Ie1FDLTOTO', $builder->build()->getPassword());
        static::assertContains('ROLE_USER', $builder->build()->getRoles());
        static::assertEquals('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6', $builder->build()->getValidationToken());
        static::assertEquals('Sun 12-Mar-2017 00:00:00', $builder->build()->getCreationDate());
        static::assertEquals('Tue 21-Mar-2017 00:00:00', $builder->build()->getValidationDate());
        static::assertTrue($builder->build()->hasBeenValidated());
        static::assertTrue($builder->build()->hasAnActiveAccount());
        static::assertEquals('24ad4a8zd4d1a464a2dz', $builder->build()->getResetToken());
        static::assertEquals('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6', $builder->build()->getApiToken());
    }

    public function testSetter()
    {
        $builder = new UserBuilder();

        $userStub = $this->createMock(UserInterface::class);
        $userStub->method('getId')
                 ->willReturn(0);

        $builder
            ->setUser($userStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testRelationWithImage()
    {
        $builder = new UserBuilder();

        $imageStub = $this->createMock(ImageInterface::class);
        $imageStub->method('getId')
                  ->willReturn(0);

        $builder
            ->create()
            ->withFirstName('Toto')
            ->withLastName('Toto')
            ->withUsername('Toto')
            ->withEmail('toto@gmail.com')
            ->withPlainPassword('Ie1FDLTOTO')
            ->withPassword('Ie1FDLTOTO')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime("2017-03-12"))
            ->withValidationDate(new \DateTime('2017-03-21'))
            ->withValidationToken('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6')
            ->withValidated(true)
            ->withActive(true)
            ->withResetToken('24ad4a8zd4d1a464a2dz')
            ->withApiToken('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6')
            ->withImage($imageStub)
        ;

        static::assertEquals(0, $builder->build()->getImage()->getId());
    }

    public function testRelationWithCompany()
    {
        $builder = new UserBuilder();

        $companyStub = $this->createMock(CompanyInterface::class);
        $companyStub->method('getId')
                    ->willReturn(0);

        $builder
            ->create()
            ->withCompany($companyStub)
        ;

        static::assertEquals(0, $builder->build()->getCompany()->getId());
    }

    public function testRelationWithNotification()
    {
        $builder = new UserBuilder();

        $notificationStub = $this->createMock(NotificationInterface::class);
        $notificationStub->method('getId')
                         ->willReturn(0);

        $builder
            ->create()
            ->withFirstName('Toto')
            ->withLastName('Toto')
            ->withUsername('Toto')
            ->withEmail('toto@gmail.com')
            ->withPlainPassword('Ie1FDLTOTO')
            ->withPassword('Ie1FDLTOTO')
            ->withRole('ROLE_USER')
            ->withCreationDate(new \DateTime("2017-03-12"))
            ->withValidationDate(new \DateTime('2017-03-21'))
            ->withValidationToken('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6')
            ->withValidated(true)
            ->withActive(true)
            ->withResetToken('24ad4a8zd4d1a464a2dz')
            ->withApiToken('24ad4a8zd4d1a464a2dz+92d4a26d35d4ad6')
            ->withNotification($notificationStub)
        ;

        static::assertEquals(0, $builder->build()->getNotifications()->offsetGet(0)->getId());

        $builder
            ->build()
            ->removeNotification($notificationStub)
        ;

        static::assertEmpty($builder->build()->getNotifications());
    }
}

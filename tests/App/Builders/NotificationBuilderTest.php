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
use App\Interactors\UserInteractor;
use App\Interactors\NotificationInteractor;

/**
 * Class NotificationBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new NotificationBuilder();

        $builder
            ->create()
            ->withLabel('New Notification !')
            ->withContent('Your account has received a notification !')
            ->withTags(['important', 'security'])
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('New Notification !', $builder->build()->getLabel());
        static::assertEquals('Your account has received a notification !', $builder->build()->getContent());
        static::assertContains(['important', 'security'], $builder->build()->getTags());
    }

    public function testSetter()
    {
        $builder = new NotificationBuilder();

        $notificationStub = $this->createMock(NotificationInteractor::class);
        $notificationStub->method('getId')
                         ->willReturn(0);

        $builder
            ->setNotification($notificationStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testRelationWithUser()
    {
        $builder = new NotificationBuilder();

        $userStub = $this->createMock(UserInteractor::class);
        $userStub->method('getId')
                 ->willReturn(0);

        $builder
            ->create()
            ->withLabel('New Notification !')
            ->withContent('Your account has received a notification !')
            ->withTags(['important', 'security'])
            ->withUser($userStub)
        ;

        static::assertEquals(0, $builder->build()->getUser()->getId());
    }
}

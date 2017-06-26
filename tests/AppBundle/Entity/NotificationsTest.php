<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

// Entity
use AppBundle\Entity\Notifications;

/**
 * Class NotificationsTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationsTest extends TestCase
{
    /**
     * Test the instantiation phase of the Notifications entity.
     */
    public function testNotificationInstance()
    {
        $notification = new Notifications();

        $notification->setName('New bills !');
        $notification->setCategory('Important');
        $notification->setContent('A new bills has been generated !');
        $notification->setCreatedAt(new \DateTime('2017-03-21'));
        $notification->setRepetition(true);
        $notification->setChecked(false);
        $notification->setLink('/user/root/notifications/march/2017');

        $this->assertEquals('New bills !', $notification->getName());
        $this->assertEquals('Important', $notification->getCategory());
        $this->assertEquals('A new bills has been generated !', $notification->getContent());
        $this->assertEquals(new \DateTime('2017-03-21'), $notification->getCreatedAt());
        $this->assertTrue($notification->hasRepetition());
        $this->assertFalse($notification->hasBeenChecked());
        $this->assertEquals('/user/root/notifications/march/2017', $notification->getLink());
    }
}

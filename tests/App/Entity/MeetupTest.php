<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\App\Entity;

use PHPUnit\Framework\TestCase;

use App\Entity\User;
use App\Entity\Meetup;
use App\Entity\Clients;
use App\Entity\Planning;

/**
 * Class MeetupTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class MeetupTest extends TestCase
{
    /**
     * Test if the object can be instantiated.
     */
    public function testInstantiation()
    {
        $meetup = new Meetup();

        $meetup->setDate(new \DateTime('2017-05-24'));
        $meetup->setPlaces('Online');
        $meetup->setDuration('45 MINUTES');
        $meetup->setType('Interview');

        $this->assertNull($meetup->getId());
        $this->assertEquals(new \DateTime('2017-05-24'), $meetup->getDate());
        $this->assertEquals('Online', $meetup->getPlaces());
        $this->assertEquals('45 MINUTES', $meetup->getDuration());
        $this->assertEquals('Interview', $meetup->getType());
    }

    /**
     * Test the relation betwwen Meetup and Planning.
     */
    public function testMeetupPlanning()
    {
        $meetup = new Meetup();

        $planning = $this->createMock(Planning::class);

        $meetup->setDate(new \DateTime('2017-05-24'));
        $meetup->setPlaces('Online');
        $meetup->setDuration('45 MINUTES');
        $meetup->setType('Interview');

        $planning->method('getPeriod')
                 ->willReturn('2017');

        $meetup->setPlanning($planning);

        if ($this->assertInstanceOf(Planning::class, $meetup->getPlanning())) {
            $this->assertEquals('2017', $planning->getPeriod());
        }
    }

    /**
     * Test the relation between Meetup and User.
     */
    public function testMeetupUser()
    {
        $meetup = new Meetup();

        $user = $this->createMock(User::class);

        $meetup->setDate(new \DateTime('2017-05-24'));
        $meetup->setPlaces('Online');
        $meetup->setDuration('45 MINUTES');
        $meetup->setType('Interview');

        $user->method('getLastName')
             ->willReturn('Potter');

        $meetup->setUser($user);

        if ($this->assertInstanceOf(User::class, $meetup->getUser())) {
            $this->assertEquals('Potter', $user->getLastName());
        }
    }

    /**
     * Test the relation between Meetup and Clients.
     */
    public function testMeetupClients()
    {
        $meetup = new Meetup();

        $clients = $this->createMock(Clients::class);

        $meetup->setDate(new \DateTime('2017-05-24'));
        $meetup->setPlaces('Online');
        $meetup->setDuration('45 MINUTES');
        $meetup->setType('Interview');

        $clients->method('getName')
                ->willReturn('Google');

        $meetup->setClients($clients);

        if ($this->assertInstanceOf(Clients::class, $meetup->getClients())) {
            $this->assertEquals('Google', $clients->getName());
        }
    }
}

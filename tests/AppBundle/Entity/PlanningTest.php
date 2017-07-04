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

use AppBundle\Entity\User;
use AppBundle\Entity\Meetup;
use AppBundle\Entity\Planning;

// PHPUnit
use PHPUnit\Framework\TestCase;

/**
 * Class PlanningTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PlanningTest extends TestCase
{
    /**
     * Test the object instantiation.
     */
    public function testInstantiation()
    {
        $planning = new Planning();

        $planning->setPeriod('2017');

        $this->assertNull($planning->getId());
        $this->assertEquals('2017', $planning->getPeriod());
    }

    /**
     * Test the relation between Planning and Meetup.
     */
    public function testPlanningMeetup()
    {
        $planning = new Planning();

        $meetup = $this->createMock(Meetup::class);

        $planning->setPeriod('2017');

        $meetup->method('getDuration')
               ->willReturn('45 Minutes');

        $planning->addMeetup($meetup);

        if ($this->assertInstanceOf(get_class($meetup), $planning->getMeetups()->get(0))) {
            $this->assertEquals('45 MINUTES', $meetup->getDuration());
        }
    }

    /**
     * Test the relation between Planning and User.
     */
    public function testPlanningUser()
    {
        $planning = new Planning();

        $user = $this->createMock(User::class);

        $planning->setPeriod('2017');

        $user->method('getLastName')
             ->willReturn('Potter');

        $planning->setUser($user);

        if ($this->assertInstanceOf(User::class, $planning->getUser())) {
            $this->assertEquals('Potter', $user->getLastName());
        }
    }
}

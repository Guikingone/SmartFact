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
use App\Entity\Bills;
use App\Entity\Meetup;
use App\Entity\Clients;

/**
 * Class ClientsTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ClientsTest extends TestCase
{
    /**
     * Test the instantiation of the class.
     */
    public function testClassInstantiation()
    {
        $clients = new Clients();

        $clients->setName('Google');
        $clients->setAddress('404 Road not found, Los Angeles');
        $clients->setPhoneNumber('0987766554');
        $clients->setPrestationType('Services');

        $this->assertNull($clients->getId());
        $this->assertEquals('Google', $clients->getName());
        $this->assertEquals('404 Road not found, Los Angeles', $clients->getAddress());
        $this->assertEquals('0987766554', $clients->getPhoneNumber());
        $this->assertEquals('Services', $clients->getPrestationType());
    }

    /**
     * Test the relation between Clients and User.
     */
    public function testClientsUser()
    {
        $clients = new Clients();
        $user = $this->createMock(User::class);

        $clients->setName('Google');
        $clients->setAddress('404 Road not found, Los Angeles');
        $clients->setPhoneNumber('0987766554');
        $clients->setPrestationType('Services');

        $user->method('getLastName')
             ->willReturn('Potter');

        $user->method('getFirstName')
             ->willReturn('Harry');

        $clients->setUser($user);

        if ($this->assertInstanceOf(User::class, $clients->getUser())) {
            $this->assertEquals('Potter', $user->getLastName());
            $this->assertEquals('Harry', $user->getFistName());
        }
    }

    /**
     * Test the relation between Clients and Bills.
     */
    public function testClientsBill()
    {
        $clients = new Clients();
        $bills = $this->createMock(Bills::class);

        $clients->setName('Google');
        $clients->setAddress('404 Road not found, Los Angeles');
        $clients->setPhoneNumber('0987766554');
        $clients->setPrestationType('Services');

        $bills->method('getId')
              ->willReturn(0);

        $bills->method('hasTVA')
              ->willReturn(true);

        $bills->method('getDate')
              ->willReturn(new \DateTime('2017-04-26'));

        $clients->addBills($bills);

        if ($this->assertInstanceOf(get_class($bills), $clients->getBills()->get(0))) {
            $this->assertTrue($bills->hasTva());
            $this->assertEquals(new \DateTime('2017-04-26'), $bills->getDate());
        }

        $clients->removeBill($bills);

        $this->assertArrayNotHasKey($bills->getId(), $clients->getBills());
    }

    /**
     * Test the relation between Clients and Meetup.
     */
    public function testClientsMeetup()
    {
        $clients = new Clients();
        $meetup = $this->createMock(Meetup::class);

        $clients->setName('Google');
        $clients->setAddress('404 Road not found, Los Angeles');
        $clients->setPhoneNumber('0987766554');
        $clients->setPrestationType('Services');

        $meetup->method('getId')
               ->willReturn(0);

        $clients->addMeetup($meetup);

        if ($this->assertInstanceOf(Meetup::class, $clients->getMeetups()->get(0))) {
            $this->assertEquals(0, $meetup->getId());
        }

        $clients->removeMeetup($meetup);

        $this->assertArrayNotHasKey($meetup->getId(), $clients->getMeetups());
    }
}

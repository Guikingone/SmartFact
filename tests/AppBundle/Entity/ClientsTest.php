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
use AppBundle\Entity\Bills;
use AppBundle\Entity\Clients;
use PHPUnit\Framework\TestCase;

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

        $bills->method('hasTVA')
              ->willReturn(true);

        $bills->method('getDate')
              ->willReturn(new \DateTime('2017-04-26'));

        $clients->addBills($bills);

        if ($this->assertInstanceOf(get_class($bills), $clients->getBills()->get(0))) {
            $this->assertTrue($bills->hasTva());
            $this->assertEquals(new \DateTime('2017-04-26'), $bills->getDate());
        }
    }
}

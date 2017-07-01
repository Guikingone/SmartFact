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

// Entities
use AppBundle\Entity\User;
use AppBundle\Entity\Bills;
use AppBundle\Entity\Clients;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


/**
 * Class BillsTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BillsTest extends TestCase
{
    /**
     * Test the instantiation of the Entity.
     */
    public function testEntityInstance()
    {
        $bills = new Bills();

        $bills->setDate(new \DateTime('2017-04-31'));
        $bills->setTotal(3000.45);
        $bills->setSend(false);
        $bills->setSendAt(new \DateTime('2017-03-02'));
        $bills->setFile('facture.pdf');

        $this->assertNull($bills->getId());
        $this->assertInstanceOf(\DateTime::class, $bills->getCreatedAt());
        $this->assertEquals(new \DateTime('2017-04-31'), $bills->getDate());
        $this->assertEquals(3000.45, $bills->getTotal());
        $this->assertFalse($bills->hasBeenSend());
        $this->assertEquals(new \DateTime('2017-03-02'), $bills->getSendAt());
        $this->assertEquals('facture.pdf', $bills->getFile());
    }

    /**
     * Test the relation between Bills and User.
     */
    public function testBillsUser()
    {
        $bills = new Bills();
        $user = $this->createMock(User::class);

        $bills->setDate(new \DateTime('2017-04-31'));
        $bills->setTotal(3000.45);
        $bills->setDate(new \DateTime('2017-02-15'));
        $bills->setSend(false);
        $bills->setSendAt(new \DateTime('2017-03-02'));
        $bills->setFile('facture.pdf');

        $user->method('getFirstName')
             ->willReturn('Harry');

        $user->method('getLastName')
             ->wilLReturn('Potter');

        $bills->setUser($user);

        if ($this->assertInstanceOf(get_class($user), $bills->getUser())) {
            $this->assertEquals('Potter', $user->getLastName());
            $this->assertEquals('Harry', $user->getFirstName());
        }
    }

    /**
     * Test the relation between Bills and Clients.
     */
    public function testBillsClients()
    {
        $bills = new Bills();
        $clients = $this->createMock(Clients::class);

        $bills->setDate(new \DateTime('2017-04-31'));
        $bills->setTotal(3000.45);
        $bills->setDate(new \DateTime('2017-02-15'));
        $bills->setSend(false);
        $bills->setSendAt(new \DateTime('2017-03-02'));
        $bills->setFile('facture.pdf');

        $clients->method('getName')
                ->willReturn('Google');

        $clients->method('getAddress')
                ->wilLReturn('404 Road Not Found');

        $bills->addClients($clients);

        if ($this->assertInstanceOf(get_class($clients), $bills->getClients()->get(0))) {
            $this->assertEquals('Google', $clients->getName());
            $this->assertEquals('404 Road Not Found', $clients->getAddress());
        }
    }

    /**
     * Test if a Bills can remove a linked Clients.
     */
    public function testBillsRemoveClients()
    {
        $bills = new Bills();
        $clients = $this->createMock(Clients::class);

        $bills->setDate(new \DateTime('2017-04-31'));
        $bills->setTotal(3000.45);
        $bills->setDate(new \DateTime('2017-02-15'));
        $bills->setSend(false);
        $bills->setSendAt(new \DateTime('2017-03-02'));
        $bills->setFile('facture.pdf');

        $clients->method('getName')
            ->willReturn('Google');

        $clients->method('getAddress')
            ->wilLReturn('404 Road Not Found');

        $clients->method('getId')
                ->willReturn(0);

        $bills->addClients($clients);

        $bills->removeClients($clients);

        $this->assertInstanceOf(ArrayCollection::class, $bills->getClients());
        $this->assertArrayNotHasKey($clients->getId(), $bills->getClients());
    }
}

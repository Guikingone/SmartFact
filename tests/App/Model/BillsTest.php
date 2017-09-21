<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\App\Model;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use App\Model\User;
use App\Model\Bills;
use App\Model\Clients;

/**
 * Class BillsTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BillsTest extends TestCase
{
    /**
     * Test the instantiation of the Model.
     */
    public function testEntityInstance()
    {
        $bills = new Bills();

        $bills->setDate(new \DateTime('2017-04-31'));
        $bills->setTotal(3000.45);
        $bills->setSend(false);
        $bills->setSendAt(new \DateTime('2017-03-02'));
        $bills->setTva(true);
        $bills->setFile('facture.pdf');

        static::assertNull($bills->getId());
        static::assertInstanceOf(\DateTime::class, $bills->getCreatedAt());
        static::assertEquals(new \DateTime('2017-04-31'), $bills->getDate());
        static::assertEquals(3000.45, $bills->getTotal());
        static::assertFalse($bills->hasBeenSend());
        static::assertEquals(new \DateTime('2017-03-02'), $bills->getSendAt());
        static::assertTrue($bills->hasTva());
        static::assertEquals('facture.pdf', $bills->getFile());
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

        if (static::assertInstanceOf(get_class($user), $bills->getUser())) {
            static::assertEquals('Potter', $user->getLastName());
            static::assertEquals('Harry', $user->getFirstName());
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

        $clients->method('getId')
                ->willReturn(0);

        $clients->method('getName')
                ->willReturn('Google');

        $clients->method('getAddress')
                ->wilLReturn('404 Road Not Found');

        $bills->addClients($clients);

        if (static::assertInstanceOf(get_class($clients), $bills->getClients()->get(0))) {
            static::assertEquals('Google', $clients->getName());
            static::assertEquals('404 Road Not Found', $clients->getAddress());
        }

        $bills->removeClients($clients);

        static::assertArrayNotHasKey($clients->getId(), $bills->getClients());
    }
}

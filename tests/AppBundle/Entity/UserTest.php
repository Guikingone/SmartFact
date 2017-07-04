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

// Symfony core
use AppBundle\Entity\Accounting;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

// Entity
use AppBundle\Entity\User;
use AppBundle\Entity\Clients;
use AppBundle\Entity\Planning;
use AppBundle\Entity\Notifications;

/**
 * Class UserTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserTest extends TestCase
{
    /**
     * Test the instantiation of the User entity.
     */
    public function testUserInstance()
    {
        $user = new User();

        $user->setFirstName('Harry');
        $user->setLastName('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->addRoles('ROLE_USER');
        $user->setRoles(['ROLE_USER']);

        $this->assertNull($user->getId());
        $this->assertEquals('Harry', $user->getFirstName());
        $this->assertEquals('Potter', $user->getLastName());
        $this->assertEquals('23 Poudlard Avenue', $user->getAddress());
        $this->assertEquals('0635459287', $user->getPhoneNumber());
        $this->assertEquals(new \DateTime('1995-03-21'), $user->getBirthDate());
        $this->assertEquals('Freelance', $user->getStatus());
        $this->assertEquals(new \DateTime('2017-02-31'), $user->getCreatedAt());
        $this->assertTrue($user->getValidated());
        $this->assertTrue($user->isEnabled());
        $this->assertEquals('HP', $user->getUsername());
        $this->assertEquals('LB,L8ELTDL0', $user->getPassword());
        $this->assertEquals('tok_0010901_001NNDOPPPANDHYEMMANDU', $user->getToken());
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    /**
     * Test if a user can be linked to a Notification.
     */
    public function testUserNotifications()
    {
        $user = new User();
        $notification = $this->createMock(Notifications::class);

        $user->setFirstName('Harry');
        $user->setLastName('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->addRoles('ROLE_USER');

        $notification->method('getName')
                     ->willReturn('A new bills has been generated !');

        $notification->method('getId')
                     ->willReturn(1);

        $notification->method('setUser')
                     ->willReturn($user);

        $user->addNotification($notification);

        if ($this->assertInstanceOf(get_class($notification), $user->getNotifications()->get(0))) {
            $this->assertContains(0, $user->getNotifications());
            $notif = $user->getNotifications()->get(0);
            $this->assertEquals('A new bills has been generated !', $notif->getName());
            $this->assertEquals(1, $notif->getId());
        }
    }

    /**
     * Test if a User can be linked to a Planning.
     */
    public function testUserPlanning()
    {
        $user = new User();
        $planning = $this->createMock(Planning::class);

        $user->setFirstName('Harry');
        $user->setLastName('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->addRoles('ROLE_USER');

        $planning->method('getPeriod')
                 ->willReturn('2017');

        $planning->method('setUser')
                 ->willReturn($user);

        $user->setPlanning($planning);

        if ($this->assertInstanceOf(get_class($planning), $user->getPlanning())) {
            $this->assertEquals('2017', $planning->getPeriod());
            $this->assertInstanceOf(User::class, $planning->getUser());
        }
    }

    /**
     * Test if a User can be linked to a Client.
     */
    public function testUserClients()
    {
        $user = new User();
        $clients = $this->createMock(Clients::class);

        $user->setFirstName('Harry');
        $user->setLastName('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->addRoles('ROLE_USER');

        $clients->method('getName')
                ->willReturn('Google');

        $clients->method('getPrestationType')
                ->willReturn('Services');

        $user->addClient($clients);

        if ($this->assertInstanceOf(get_class($clients), $user->getClients()->get(0))) {
            $client = $user->getNotifications()->get(0);
            $this->assertEquals('Google', $client->getName());
            $this->assertEquals('Services', $client->getTypePrestation());
        }
    }

    /**
     * Test the relation between User and Accounting.
     */
    public function testUserAccounting()
    {
        $user = new User();
        $accounting = $this->createMock(Accounting::class);

        $user->setFirstName('Harry');
        $user->setLastName('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->addRoles('ROLE_USER');

        $accounting->method('getName')
                   ->willReturn('DA Expertise');

        $user->setAccounting($accounting);

        if ($this->assertInstanceOf(Accounting::class, $user->getAccounting())) {
            $this->assertEquals('DA Expertise', $accounting->getName());
        }

    }
}

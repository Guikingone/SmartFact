<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\App\Resolvers;

use App\Model\User;
use App\Model\Bills;
use App\Model\Meetup;
use App\Model\Clients;
use App\Model\Planning;
use App\Model\Accounting;
use App\Model\Notifications;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

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

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setEmail('hp@gmail.com');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPlainPassword('LB,L8ELTDL0');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->setRoles('ROLE_USER');
        $user->setScope($user::PROFESSIONAL_USER);
        $user->setState('9848Y2GD9873N2');

        static::assertNull($user->getId());
        static::assertEquals('Harry', $user->getFirstname());
        static::assertEquals('Potter', $user->getLastname());
        static::assertEquals('23 Poudlard Avenue', $user->getAddress());
        static::assertEquals('0635459287', $user->getPhoneNumber());
        static::assertEquals('hp@gmail.com', $user->getEmail());
        static::assertEquals(new \DateTime('1995-03-21'), $user->getBirthDate());
        static::assertEquals('Freelance', $user->getStatus());
        static::assertEquals(new \DateTime('2017-02-31'), $user->getCreatedAt());
        static::assertTrue($user->getValidated());
        static::assertTrue($user->isEnabled());
        static::assertEquals('HP', $user->getUsername());
        static::assertEquals('LB,L8ELTDL0', $user->getPlainPassword());
        static::assertEquals('LB,L8ELTDL0', $user->getPassword());
        static::assertEquals('tok_0010901_001NNDOPPPANDHYEMMANDU', $user->getToken());
        static::assertEquals('ROLE_USER', $user->getRoles());
        static::assertEquals('professional_user', $user->getScope());
        static::assertEquals('9848Y2GD9873N2', $user->getState());
    }

    /**
     * Test the relation between User and Notifications.
     */
    public function testUserNotifications()
    {
        $user = new User();
        $notification = $this->createMock(Notifications::class);

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setEmail('hp@gmail.com');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->setRoles('ROLE_USER');

        $notification->method('getName')
                     ->willReturn('A new bills has been generated !');

        $notification->method('getId')
                     ->willReturn(1);

        $notification->method('setUser')
                     ->willReturn($user);

        $user->addNotification($notification);

        if (static::assertInstanceOf(get_class($notification), $user->getNotifications()->get(0))) {
            static::assertContains(0, $user->getNotifications());
            $notif = $user->getNotifications()->get(0);
            static::assertEquals('A new bills has been generated !', $notif->getName());
            static::assertEquals(1, $notif->getId());
        }

        $user->removeNotification($notification);

        static::assertArrayNotHasKey($notification->getId(), $user->getNotifications());
    }

    /**
     * Test the relation between User and Bills.
     */
    public function testUserBills()
    {
        $user = new User();
        $bills = $this->createMock(Bills::class);

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setEmail('hp@gmail.com');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->setRoles('ROLE_USER');

        $bills->method('getId')
              ->willReturn(0);

        $user->addBill($bills);

        if (static::assertInstanceOf(Bills::class, $user->getBills()->get(0))) {
            static::assertNull($bills->getId());
        }

        $user->removeBill($bills);

        static::assertArrayNotHasKey($bills->getId(), $user->getBills());

    }

    /**
     * Test if a User can be linked to a Planning.
     */
    public function testUserPlanning()
    {
        $user = new User();
        $planning = $this->createMock(Planning::class);

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setEmail('hp@gmail.com');
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

        if (static::assertInstanceOf(get_class($planning), $user->getPlanning())) {
            static::assertEquals('2017', $planning->getPeriod());
            static::assertInstanceOf(UserResolver::class, $planning->getUser());
        }
    }

    /**
     * Test the relation between User and Meetup.
     */
    public function testUserMeetups()
    {
        $user = new User();
        $meetup = $this->createMock(Meetup::class);

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setEmail('hp@gmail.com');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->addRoles('ROLE_USER');

        $meetup->method('getId')
               ->willReturn(0);

        $meetup->method('getDate')
               ->willReturn(new \DateTime('2017-02-31'));

        $user->addMeetup($meetup);

        if (static::assertInstanceOf(get_class($meetup), $user->getMeetups()->get(0))) {
            static::assertEquals(new \DateTime('2017-02-31'), $meetup->getDate());
        }

        $user->removeMeetup($meetup);

        static::assertArrayNotHasKey($meetup->getId(), $user->getMeetups());
    }

    /**
     * Test if a User can be linked to a Client.
     */
    public function testUserClients()
    {
        $user = new User();
        $clients = $this->createMock(Clients::class);

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
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

        $clients->method('getId')
                ->willReturn(0);

        $clients->method('getName')
                ->willReturn('Google');

        $clients->method('getPrestationType')
                ->willReturn('Services');

        $user->addClient($clients);

        if (static::assertInstanceOf(get_class($clients), $user->getClients()->get(0))) {
            $client = $user->getNotifications()->get(0);
            static::assertEquals('Google', $client->getName());
            static::assertEquals('Services', $client->getTypePrestation());
        }

        $user->removeClient($clients);

        static::assertArrayNotHasKey($clients->getId(), $user->getClients());
    }

    /**
     * Test the relation between User and Accounting.
     */
    public function testUserAccounting()
    {
        $user = new User();
        $accounting = $this->createMock(Accounting::class);

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
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

        if (static::assertInstanceOf(Accounting::class, $user->getAccounting())) {
            static::assertEquals('DA Expertise', $accounting->getName());
        }
    }
}

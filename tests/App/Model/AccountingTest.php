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

use App\Model\User;
use App\Model\Accounting;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class AccountingTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class AccountingTest extends TestCase
{
    /**
     * Test the instantiation of the Model;
     */
    public function testEntityInstantiation()
    {
        $accounting = new Accounting();

        $accounting->setName('Cabinet Intox');
        $accounting->setAddress('404 Road Not Found');
        $accounting->setPhoneNumber('0987654321');
        $accounting->setInterlocutor('Mr Not Found');
        $accounting->setEmail('notfound@intox.com');

        static::assertNull($accounting->getId());
        static::assertEquals('Cabinet Intox', $accounting->getName());
        static::assertEquals('404 Road Not Found', $accounting->getAddress());
        static::assertEquals('0987654321', $accounting->getPhoneNumber());
        static::assertEquals('Mr Not Found', $accounting->getInterlocutor());
        static::assertEquals('notfound@intox.com', $accounting->getEmail());
    }

    /**
     * Test the relation between Accounting and User.
     */
    public function testAccountingUser()
    {
        $accounting = new Accounting();
        $user = $this->createMock(User::class);

        $accounting->setName('Cabinet Intox');
        $accounting->setAddress('404 Road Not Found');
        $accounting->setPhoneNumber('0987654321');
        $accounting->setInterlocutor('Mr Not Found');
        $accounting->setEmail('notfound@intox.com');

        $user->method('getId')
             ->willReturn(0);

        $user->method('getLastName')
             ->willReturn('Potter');

        $accounting->addUser($user);

        if (static::assertInstanceOf(get_class($user), $accounting->getUser()->get(0))) {
            static::assertEquals('Potter', $user->getLastName());
        }

        $accounting->removeUser($user);

        static::assertArrayNotHasKey($user->getId(), $accounting->getUser());
    }
}

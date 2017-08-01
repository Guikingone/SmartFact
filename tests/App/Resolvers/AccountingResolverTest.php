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
use App\Resolvers\AccountingResolver;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class AccountingResolverTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class AccountingResolverTest extends TestCase
{
    /**
     * Test the instantiation of the Model;
     */
    public function testEntityInstantiation()
    {
        $accounting = new AccountingResolver();

        $accounting->setName('Cabinet Intox');
        $accounting->setAddress('404 Road Not Found');
        $accounting->setPhoneNumber('0987654321');
        $accounting->setInterlocutor('Mr Not Found');
        $accounting->setEmail('notfound@intox.com');

        $this->assertNull($accounting->getId());
        $this->assertEquals('Cabinet Intox', $accounting->getName());
        $this->assertEquals('404 Road Not Found', $accounting->getAddress());
        $this->assertEquals('0987654321', $accounting->getPhoneNumber());
        $this->assertEquals('Mr Not Found', $accounting->getInterlocutor());
        $this->assertEquals('notfound@intox.com', $accounting->getEmail());
    }

    /**
     * Test the relation between Accounting and User.
     */
    public function testAccountingUser()
    {
        $accounting = new AccountingResolver();
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

        if ($this->assertInstanceOf(get_class($user), $accounting->getUser()->get(0))) {
            $this->assertEquals('Potter', $user->getLastName());
        }

        $accounting->removeUser($user);

        $this->assertArrayNotHasKey($user->getId(), $accounting->getUser());
    }
}

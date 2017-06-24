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
use PHPUnit\Framework\TestCase;

// Bundle
use AppBundle\Entity\User;

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
}

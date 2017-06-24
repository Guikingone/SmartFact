<?php

/*
 * This file is part of the Smartfact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SmartFact\UserBundle\Tests\Managers\API;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use AppBundle\Entity\User;
use AppBundle\Managers\API\ApiUserManager;

/**
 * Class ApiUserManagerTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiUserManagerTest extends KernelTestCase
{
    private $manager;

    /** {@inheritdoc} */
    public function setUp()
    {
        self::bootKernel();

        $this->manager = static::$kernel->getContainer()->get(ApiUserManager::class);
    }

    /**
     * Test if the manager is a instance of the right class.
     */
    public function testManagerIsInstanceOf()
    {
        if (is_object($this->manager)) {
            $this->assertInstanceOf(ApiUserManager::class, $this->manager);
        }
    }

    /**
     * Test if the manager return the right instances.
     */
    public function testManagerGetUsers()
    {
        if (is_object($this->manager) && $this->manager instanceof ApiUserManager) {
            $this->assertContains(User::class, $this->manager->getUsers());
        }
    }
}

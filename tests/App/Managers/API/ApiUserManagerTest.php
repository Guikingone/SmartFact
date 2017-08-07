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

use App\Managers\API\ApiUserManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class ApiUserManagerTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiUserManagerTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::bootKernel();
    }

    /**
     * Test if the Container return the right manager.
     */
    public function testContainerReturn()
    {
        $manager = static::$kernel->getContainer()
                                  ->get(ApiUserManager::class);

        static::assertInstanceOf(ApiUserManager::class, $manager);
    }

    /**
     * Test if the manager has the right attributes.
     */
    public function testManagerHasAttributes()
    {
        $manager = static::$kernel->getContainer()
                                  ->get(ApiUserManager::class);

        if (static::assertInstanceOf(ApiUserManager::class, $manager)) {
            $clone = $this->createMock(get_class($manager));
            static::assertObjectHasAttribute('serializer', $clone);
            static::assertObjectHasAttribute('doctrine', $clone);
        }
    }
}

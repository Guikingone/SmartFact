<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Managers\API;

use AppBundle\Managers\API\ApiNotificationsManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class ApiNotificationsManagerTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiNotificationsManagerTest extends KernelTestCase
{
    /** {@inheritdoc} */
    public function setUp()
    {
        static::bootKernel();
    }

    /**
     * Test that the Container return the right manager.
     */
    public function testContainerReturn()
    {
        $manager = static::$kernel->getContainer()
                                  ->get(ApiNotificationsManager::class);

        $this->assertInstanceOf(ApiNotificationsManager::class, $manager);
    }

    /**
     * Test if the manager has the right attributes.
     */
    public function testManagerHasAttributes()
    {
        $manager = static::$kernel->getContainer()
            ->get(ApiNotificationsManager::class);

        if ($this->assertInstanceOf(ApiNotificationsManager::class, $manager)) {
            $clone = $this->createMock(get_class($manager));
            $this->assertObjectHasAttribute('serializer', $clone);
            $this->assertObjectHasAttribute('doctrine', $clone);
        }
    }
}

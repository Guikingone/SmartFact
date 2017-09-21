<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Managers\Web\Unit;

// Manager
use App\Managers\Web\WebNotificationsManager;

// Core
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class WebNotificationsManagerTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebNotificationsManagerTest extends KernelTestCase
{
    /** {@inheritdoc} */
    public function setUp()
    {
        static::bootKernel();
    }

    /**
     * Test if the Container return the right instance.
     */
    public function testContainerReturn()
    {
        $manager = static::$kernel->getContainer()
                                  ->get(WebNotificationsManager::class);

        $this->assertInstanceOf(WebNotificationsManager::class, $manager);
    }

    /**
     * Test if the Manager has the right attributes.
     */
    public function testObjectHasAttributes()
    {
        $manager = static::$kernel->getContainer()
                                  ->get(WebNotificationsManager::class);

        $this->assertObjectHasAttribute('entityManager', $manager);
        $this->assertObjectHasAttribute('eventDispatcher', $manager);
    }
}

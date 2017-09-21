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

use App\Managers\Web\WebAccountingManager;

// Core
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class WebAccountingManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebAccountingManagerTest extends KernelTestCase
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
                                  ->get(WebAccountingManager::class);

        $this->assertInstanceOf(WebAccountingManager::class, $manager);
    }

    /**
     * Test if the Manager has the right attributes.
     */
    public function testObjectHasAttributes()
    {
        $manager = static::$kernel->getContainer()
                                  ->get(WebAccountingManager::class);

        $this->assertObjectHasAttribute('doctrine', $manager);
        $this->assertObjectHasAttribute('form', $manager);
        $this->assertObjectHasAttribute('eventDispatcher', $manager);
    }
}

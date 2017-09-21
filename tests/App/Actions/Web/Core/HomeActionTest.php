<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\App\Actions\Web\Core;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

// Action
use App\Action\Web\HomeAction;

/**
 * Class HomeActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class HomeActionTest extends KernelTestCase
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
        $action = static::$kernel->getContainer()
                                 ->get(HomeAction::class);

        $this->assertInstanceOf(HomeAction::class, $action);
    }

    /**
     * Test if the Action has the TwigEngine attribute.
     */
    public function testActionHasTwig()
    {
        $action = static::$kernel->getContainer()
                                 ->get(HomeAction::class);

        $this->assertObjectHasAttribute('twig', $action);
    }
}

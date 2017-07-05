<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Actions\Web\Unit;

use AppBundle\Action\Web\Security\RegisterAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class RegisterActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterActionTest extends KernelTestCase
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
                                 ->get(RegisterAction::class);

        $this->assertInstanceOf(RegisterAction::class, $action);
    }

    /**
     * Test if the object has the right attributes.
     */
    public function testObjectHasAttributes()
    {
        $action = static::$kernel->getContainer()
                                 ->get(RegisterAction::class);

        $this->assertObjectHasAttribute('manager', $action);
        $this->assertObjectHasAttribute('templating', $action);
        $this->assertObjectHasAttribute('requestStack', $action);
    }
}

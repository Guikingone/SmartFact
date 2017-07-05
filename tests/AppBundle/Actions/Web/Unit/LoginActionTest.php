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

// Manager
use AppBundle\Action\Web\Security\LoginAction;

// Core
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class LoginActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoginActionTest extends KernelTestCase
{
    /** {@inheritdoc} */
    public function setUp()
    {
        static::bootKernel();
    }

    /**
     * Test if the container return the right instance.
     */
    public function testContainerReturn()
    {
        $manager = static::$kernel->getContainer()
                                  ->get(LoginAction::class);

        $this->assertInstanceOf(LoginAction::class, $manager);
    }

    /**
     * Test if the object has the right attributes.
     */
    public function testObjectHasAttributes()
    {
        $manager = static::$kernel->getContainer()
            ->get(LoginAction::class);

        $this->assertObjectHasAttribute('templating', $manager);
        $this->assertObjectHasAttribute('authentication', $manager);
    }
}

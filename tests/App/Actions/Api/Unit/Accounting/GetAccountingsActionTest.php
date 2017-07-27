<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Actions\Api\Unit\Accounting;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Action\Api\Accounting\GetAccountingsAction;

/**
 * Class GetAccountingsActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GetAccountingsActionTest extends KernelTestCase
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
                                 ->get(GetAccountingsAction::class);

        $this->assertInstanceOf(GetAccountingsAction::class, $action);
    }

    /**
     * Test if the object has the right Attributes.
     */
    public function testObjectHasAttributes()
    {
        $action = static::$kernel->getContainer()
                                 ->get(GetAccountingsAction::class);

        $this->assertObjectHasAttribute('manager', $action);
    }
}

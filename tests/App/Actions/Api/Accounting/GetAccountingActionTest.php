<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Actions\Api\Accounting;

use App\Action\Api\Accounting\GetAccountingAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class GetAccountingActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GetAccountingActionTest extends KernelTestCase
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
                                 ->get(GetAccountingAction::class);

        static::assertInstanceOf(GetAccountingAction::class, $action);
    }

    /**
     * Test if the object has the right attributes.
     */
    public function testObjectHasAttributes()
    {
        $action = static::$kernel->getContainer()
                                 ->get(GetAccountingAction::class);

        static::assertObjectHasAttribute('manager', $action);
        static::assertObjectHasAttribute('requestStack', $action);
    }
}

<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\App\Actions\Api\Accounting;

use App\Action\Api\Accounting\PostAccountingAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class PostAccountingActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PostAccountingActionTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
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
                                 ->get(PostAccountingAction::class);

        static::assertInstanceOf(PostAccountingAction::class, $action);
    }

    /**
     * Test if the object has the right attributes.
     */
    public function testObjectHasAttributes()
    {
        $action = static::$kernel->getContainer()
                                 ->get(PostAccountingAction::class);

        static::assertObjectHasAttribute('manager', $action);
        static::assertObjectHasAttribute('requestStack', $action);
    }
}

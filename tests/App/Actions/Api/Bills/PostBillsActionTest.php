<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\App\Actions\Api\Bills;

use App\Action\Api\Bills\PostBillsAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class PostBillsActionTest
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PostBillsActionTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        static::bootKernel();
    }

    /**
     * Test if the container can return the right class.
     */
    public function testContainerReturn()
    {
        $action = static::$kernel->getContainer()
                                 ->get(PostBillsAction::class);

        static::assertInstanceOf(PostBillsAction::class, $action);
    }

    /**
     * Test if the object has the right attributes.
     */
    public function testObjectHasAttributes()
    {
        $action = static::$kernel->getContainer()
                                 ->get(PostBillsAction::class);

        static::assertObjectHasAttribute('manager', $action);
        static::assertObjectHasAttribute('requestStack', $action);
    }
}

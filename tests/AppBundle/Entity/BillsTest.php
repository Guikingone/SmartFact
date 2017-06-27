<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

// Entities
use AppBundle\Entity\Bills;

/**
 * Class BillsTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BillsTest extends TestCase
{
    /**
     * Test the instantiation of the Entity.
     */
    public function testEntityInstance()
    {
        $bills = new Bills();

        $bills->setDate(new \DateTime('2017-04-31'));

        $this->assertNull($bills->getId());
        $this->assertEquals(new \DateTime('2017-04-31'), $bills->getDate());
    }
}

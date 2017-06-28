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

use AppBundle\Entity\Accounting;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class AccountingTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class AccountingTest extends TestCase
{
    public function testInstantiation()
    {
        $accounting = new Accounting();

        $this->assertNull($accounting->getId());
    }
}
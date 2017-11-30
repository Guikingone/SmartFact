<?php

declare(strict_types=1);

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Builders;

use PHPUnit\Framework\TestCase;

/**
 * Class AccountingBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class AccountingBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new AccountingBuilder();

        $builder
            ->create()
        ;

        static::assertNull($builder->build()->getId());
    }
}

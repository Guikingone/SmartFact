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
 * Class CompanyBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CompanyBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new CompanyBuilder();

        $builder
            ->create()
        ;

        static::assertNull($builder->build()->getId());
    }
}

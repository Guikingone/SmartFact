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
use App\Models\Interfaces\CompanyInterface;

/**
 * Class UserBuilderTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserBuilderTest extends TestCase
{
    public function testInstantiation()
    {
        $builder = new UserBuilder();

        $builder
            ->create()
        ;

        static::assertNull($builder->build()->getId());
    }

    public function testRelationWithCompany()
    {
        $builder = new UserBuilder();

        $companyStub = $this->createMock(CompanyInterface::class);
        $companyStub->method('getId')
                    ->willReturn(0);

        $builder
            ->create()
            ->withCompany($companyStub)
        ;

        static::assertEquals(0, $builder->build()->getCompany()->getId());
    }
}

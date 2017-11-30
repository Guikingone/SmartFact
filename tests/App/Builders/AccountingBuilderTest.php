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
use App\Models\Interfaces\AccountingInterface;

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
            ->withName('Mr Accounting')
            ->withInterlocutor('Mr Bills')
            ->withPhoneNumber('+330000000000')
            ->withEmail('mr.bills@accounting.fr')
            ->withAddress('404 Not Found Road')
        ;

        static::assertNull($builder->build()->getId());
        static::assertEquals('Mr Accounting', $builder->build()->getName());
        static::assertEquals('Mr Bills', $builder->build()->getInterlocutor());
        static::assertEquals('+330000000000', $builder->build()->getPhoneNumber());
        static::assertEquals('mr.bills@accounting.fr', $builder->build()->getEmail());
        static::assertEquals('404 Not Found Road', $builder->build()->getAddress());
    }

    public function testSetter()
    {
        $builder = new AccountingBuilder();

        $accountingStub = $this->createMock(AccountingInterface::class);
        $accountingStub->method('getId')
                       ->willReturn(0);

        $builder
            ->setAccounting($accountingStub)
        ;

        static::assertEquals(0, $builder->build()->getId());
    }

    public function testRelationWithCompany()
    {
        $builder = new AccountingBuilder();

        $companyStub = $this->createMock(CompanyInterface::class);
        $companyStub->method('getId')
                    ->willReturn(0);

        $builder
            ->create()
            ->withName('Mr Accounting')
            ->withInterlocutor('Mr Bills')
            ->withPhoneNumber('+330000000000')
            ->withEmail('mr.bills@accounting.fr')
            ->withAddress('404 Not Found Road')
            ->withCompany($companyStub)
        ;

        static::assertEquals(0, $builder->build()->getCompany()->getId());
    }
}

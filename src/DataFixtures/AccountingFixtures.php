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

namespace App\DataFixtures;

use App\Builders\AccountingBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AccountingFixtures
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class AccountingFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $builder = new AccountingBuilder();

        $builder
            ->create()
            ->withName('Mr Accounting')
            ->withInterlocutor('Mr Accounting')
            ->withPhoneNumber('+330000000000')
            ->withEmail('mr.bills@accounting.fr')
            ->withAddress('404 Not Found Road')
        ;

        $builderII = new AccountingBuilder();

        $builderII
            ->create()
            ->withName('Mr Bill')
            ->withInterlocutor('Mr Bill')
            ->withPhoneNumber('+330000000000')
            ->withEmail('mr.bills@accounting.fr')
            ->withAddress('404 Not Found Road')
        ;

        $builderIII = new AccountingBuilder();

        $builderIII
            ->create()
            ->withName('Mr Money')
            ->withInterlocutor('Mr Money')
            ->withPhoneNumber('+330000000000')
            ->withEmail('mr.bills@accounting.fr')
            ->withAddress('404 Not Found Road')
        ;

        $builderIV = new AccountingBuilder();

        $builderIV
            ->create()
            ->withName('Mr Month')
            ->withInterlocutor('Mr Month')
            ->withPhoneNumber('+330000000000')
            ->withEmail('mr.bills@accounting.fr')
            ->withAddress('404 Not Found Road')
        ;

        $manager->persist($builder);
        $manager->persist($builderII);
        $manager->persist($builderIII);
        $manager->persist($builderIV);

        $manager->flush();
    }
}

<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures\MongoDB;

use App\Model\Accounting;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadAccountingData
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoadAccountingData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $accounting = new Accounting();
        $accounting->setName('Test Entreprise');
        $accounting->setInterlocutor('Mr test');
        $accounting->setEmail('mrtest@test.com');
        $accounting->setPhoneNumber('0000000000');
        $accounting->setAddress('404 Not Found');
        $accounting->addUser($this->getReference('user'));

        $this->addReference('accounting', $accounting);

        $manager->persist($accounting);
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 2;
    }
}

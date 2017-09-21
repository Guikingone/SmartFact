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

        $accountingI = new Accounting();
        $accountingI->setName('Test Enterprise');
        $accountingI->setInterlocutor('Mr Enter');
        $accountingI->setEmail('mrEnter@test.com');
        $accountingI->setPhoneNumber('0000000000');
        $accountingI->setAddress('404 Not Found');
        $accountingI->addUser($this->getReference('user'));

        $this->addReference('accountingI', $accounting);

        $accountingII = new Accounting();
        $accountingII->setName('Test Enteprise');
        $accountingII->setInterlocutor('Mr est');
        $accountingII->setEmail('mrEst@test.com');
        $accountingII->setPhoneNumber('0000000000');
        $accountingII->setAddress('404 Not Found');
        $accountingII->addUser($this->getReference('user'));

        $this->addReference('accountingII', $accounting);

        $user = $this->getReference('user');
        $user->setAccounting($accounting);

        $userI = $this->getReference('userI');
        $userI->setAccounting($accountingI);

        $userII = $this->getReference('userII');
        $userII->setAccounting($accountingII);

        $manager->persist($accounting);
        $manager->persist($accountingI);
        $manager->persist($accountingII);
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}

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

use App\Model\Bills;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadBillsData
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoadBillsData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $bill = new Bills();
        $bill->setDate(new \DateTime());
        $bill->setTotal(3000.20);
        $bill->setTva(true);
        $bill->setSend(false);
        $bill->setUser($this->getReference('user'));

        $this->addReference('bill', $bill);

        $bill_II = new Bills();
        $bill_II->setDate(new \DateTime());
        $bill_II->setTotal(3200.20);
        $bill_II->setTva(true);
        $bill_II->setSend(false);
        $bill_II->setUser($this->getReference('user'));

        $this->addReference('bill_II', $bill_II);

        $bill_III = new Bills();
        $bill_III->setDate(new \DateTime());
        $bill_III->setTotal(3500.20);
        $bill_III->setTva(true);
        $bill_III->setSend(false);
        $bill_III->setUser($this->getReference('user'));

        $this->addReference('bill_III', $bill_III);

        $user = $this->getReference('user');
        $user->addBill($bill);

        $user = $this->getReference('user');
        $user->addBill($bill_II);

        $user = $this->getReference('user');
        $user->addBill($bill_III);

        $manager->persist($bill);
        $manager->persist($bill_II);
        $manager->persist($bill_III);
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

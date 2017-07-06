<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

// Entity
use AppBundle\Entity\Accounting;

// Core
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Class LoadAccountingData
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoadAccountingData implements FixtureInterface
{
    /** {@inheritdoc} */
    public function load(ObjectManager $manager)
    {
        $accounting = new Accounting();
        $accounting->setName('Not Found Service');
        $accounting->setInterlocutor('Mr Nowhere');
        $accounting->setEmail('nowhere@notfound.com');
        $accounting->setPhoneNumber('0987654321');
        $accounting->setAddress('404 Not Found Road');

        $manager->persist($accounting);
        $manager->flush();
    }

    /** {@inheritdoc} */
    public function getOrder()
    {
        return 2;
    }
}

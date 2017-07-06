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
        // $accounting = new Accounting();
    }

    /** {@inheritdoc} */
    public function getOrder()
    {
        return 2;
    }
}

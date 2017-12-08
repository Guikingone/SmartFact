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

namespace App\DataFixtures\ORM;

use App\Builders\ImageBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class ImageFixtures
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $builder = new ImageBuilder();

        $builder
            ->create()
            ->withName('NewImage')
            ->withExtension('.png')
            ->withSize('25Ko')
            ->withUploadDate(new \DateTime('2017-03-15'))
            ->withModificationDate(new \DateTime('2017-03-16'))
            ->withLocalPath('/public/images/NewImage.png')
            ->withPublicPath('http://domain.extension/public/images/NewImage.png')
        ;

        $manager->persist($builder->build());
    }

    /**
     * {@inheritdoc}
     */
    function getDependencies()
    {
        // TODO: Implement getDependencies() method.
    }
}
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

use App\Builders\ImageBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ImageFixtures
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageFixtures extends Fixture
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

        $builderII = new ImageBuilder();

        $builderII
            ->create()
            ->withName('NewImageII')
            ->withExtension('.png')
            ->withSize('25Ko')
            ->withUploadDate(new \DateTime('2017-03-15'))
            ->withModificationDate(new \DateTime('2017-03-16'))
            ->withLocalPath('/public/images/NewImageII.png')
            ->withPublicPath('http://domain.extension/public/images/NewImageII.png')
        ;

        $builderIII = new ImageBuilder();

        $builderIII
            ->create()
            ->withName('NewImageIII')
            ->withExtension('.png')
            ->withSize('25Ko')
            ->withUploadDate(new \DateTime('2017-03-15'))
            ->withModificationDate(new \DateTime('2017-03-16'))
            ->withLocalPath('/public/images/NewImageIII.png')
            ->withPublicPath('http://domain.extension/public/images/NewImageIII.png')
        ;

        $manager->persist($builder->build());
        $manager->persist($builderII->build());
        $manager->persist($builderIII->build());
        $manager->flush();
    }
}
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

use App\Model\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadUserData
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoadUserData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setFirstname('Harry');
        $user->setLastname('Potter');
        $user->setAddress('23 Poudlard Avenue');
        $user->setPhoneNumber('0635459287');
        $user->setEmail('hp@gmail.com');
        $user->setBirthDate(new \DateTime('1995-03-21'));
        $user->setStatus('Freelance');
        $user->setCreatedAt(new \DateTime('2017-02-31'));
        $user->setValidated(true);
        $user->setUsername('HP');
        $user->setPlainPassword('LB,L8ELTDL0');
        $user->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $user->setRoles('ROLE_USER');

        $password = $this->container->get('security.password_encoder')
                                    ->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $this->addReference('user', $user);

        $manager->persist($user);
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

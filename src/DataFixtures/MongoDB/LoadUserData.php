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


        $userI = new User();

        $userI->setFirstname('Ben');
        $userI->setLastname('Potter');
        $userI->setAddress('23 Poudlard Avenue');
        $userI->setPhoneNumber('0635459287');
        $userI->setEmail('bp@gmail.com');
        $userI->setBirthDate(new \DateTime('1995-03-21'));
        $userI->setStatus('Freelance');
        $userI->setCreatedAt(new \DateTime('2017-02-31'));
        $userI->setValidated(true);
        $userI->setUsername('BP');
        $userI->setPlainPassword('LB,L8ELTDL0');
        $userI->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $userI->setRoles('ROLE_USER');

        $password = $this->container->get('security.password_encoder')
            ->encodePassword($userI, $userI->getPlainPassword());
        $userI->setPassword($password);

        $this->addReference('userI', $userI);

        $userII = new User();

        $userII->setFirstname('Tobias');
        $userII->setLastname('Potter');
        $userII->setAddress('23 Poudlard Avenue');
        $userII->setPhoneNumber('0635459287');
        $userII->setEmail('tp@gmail.com');
        $userII->setBirthDate(new \DateTime('1995-03-21'));
        $userII->setStatus('Freelance');
        $userII->setCreatedAt(new \DateTime('2017-02-31'));
        $userII->setValidated(true);
        $userII->setUsername('TP');
        $userII->setPlainPassword('LB,L8ELTDL0');
        $userII->setToken('tok_0010901_001NNDOPPPANDHYEMMANDU');
        $userII->setRoles('ROLE_USER');

        $password = $this->container->get('security.password_encoder')
            ->encodePassword($userII, $userII->getPlainPassword());
        $userII->setPassword($password);

        $this->addReference('userII', $userII);

        $manager->persist($user);
        $manager->persist($userI);
        $manager->persist($userII);
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }
}

<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Interfaces\SmartFactClientsInterface;

/**
 * Class Clients
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_clients")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientsRepository")
 */
class Clients implements SmartFactClientsInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=150)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=15)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="prestation_type", type="string", length=100)
     */
    private $prestationType;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="clients")
     */
    private $user;

    /**
     * @var Bills
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bills", mappedBy="clients")
     */
    private $bills;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     */
    public function setName($name)
    {
        if ((!is_string($name)) || (strlen($name) > 200)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t valid or too long ! 
                            Given %s, expected string',
                    gettype($name)
                )
            );
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @throws \InvalidArgumentException
     */
    public function setAddress($address)
    {
        if ((!is_string($address)) || (strlen($address) > 150)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t valid or too long ! 
                            Given %s, expected string',
                    gettype($address)
                )
            );
        }

        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @throws \InvalidArgumentException
     */
    public function setPhoneNumber($phoneNumber)
    {
        if ((!is_string($phoneNumber)) || (strlen($phoneNumber) > 15)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t valid or too long !
                            Given %s, expected string.',
                    gettype($phoneNumber)
                )
            );
        }

        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPrestationType()
    {
        return $this->prestationType;
    }

    /**
     * @param string $prestationType
     *
     * @throws \InvalidArgumentException
     */
    public function setPrestationType($prestationType)
    {
        if ((!is_string($prestationType)) || (strlen($prestationType) > 100)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t valid or too long !
                            Given %s',
                    gettype($prestationType)
                )
            );
        }

        $this->prestationType = $prestationType;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @throws \InvalidArgumentException
     */
    public function setUser(User $user)
    {
        if (!$user instanceof User) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t valid !
                            Given %s',
                    gettype($user)
                )
            );
        }

        $this->user = $user;
    }
}

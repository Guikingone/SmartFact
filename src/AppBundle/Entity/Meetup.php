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

/**
 * Class Meetup
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_meetup")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetupRepository")
 */
class Meetup
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="places", type="string", length=100)
     */
    private $places;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=125)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    /**
     * @var Planning
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Planning", inversedBy="meetup")
     */
    private $planning;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="meetup")
     */
    private $user;

    /**
     * @var Clients
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Clients", inversedBy="meetup")
     */
    private $clients;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * @param string $places
     */
    public function setPlaces($places)
    {
        $this->places = $places;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Planning
     */
    public function getPlanning()
    {
        return $this->planning;
    }

    /**
     * @param Planning $planning
     */
    public function setPlanning(Planning $planning)
    {
        $this->planning = $planning;
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
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Clients
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * @param Clients $clients
     */
    public function setClients(Clients $clients)
    {
        $this->clients = $clients;
    }
}

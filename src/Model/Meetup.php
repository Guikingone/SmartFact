<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

// Interface
use App\Interfaces\SmartFactMeetupInterface;

/**
 * Class Meetup
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Meetup implements SmartFactMeetupInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $places;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var string
     */
    private $type;

    private $planning;

    private $user;

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

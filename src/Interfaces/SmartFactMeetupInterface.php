<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Interfaces;

use App\Entity\User;
use App\Entity\Clients;
use App\Entity\Planning;

/**
 * Interface SmartFactMeetupInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactMeetupInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * @param \DateTime $date
     */
    public function setDate($date);

    /**
     * @return string
     */
    public function getPlaces();

    /**
     * @param string $places
     */
    public function setPlaces($places);

    /**
     * @return string
     */
    public function getDuration();

    /**
     * @param string $duration
     */
    public function setDuration($duration);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);

    /**
     * @return Planning
     */
    public function getPlanning();

    /**
     * @param Planning $planning
     */
    public function setPlanning(Planning $planning);

    /**
     * @return User
     */
    public function getUser();

    /**
     * @param User $user
     */
    public function setUser(User $user);

    /**
     * @return Clients
     */
    public function getClients();

    /**
     * @param Clients $clients
     */
    public function setClients(Clients $clients);
}

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

use App\Model\User;
use App\Model\Meetup;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface SmartFactPlanningInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactPlanningInterface
{
    /**
     * @return null|int
     */
    public function getId();

    /**
     * @return string
     */
    public function getPeriod() : string;

    /**
     * @param string $period
     * @return mixed
     */
    public function setPeriod(string $period);

    /**
     * @param Meetup $meetup
     * @return mixed
     */
    public function addMeetup(Meetup $meetup);

    /**
     * @param Meetup $meetup
     * @return mixed
     */
    public function removeMeetup(Meetup $meetup);

    /**
     * @return ArrayCollection
     */
    public function getMeetups() : ArrayCollection;

    /**
     * @param User $user
     * @return mixed
     */
    public function setUser(User $user);

    /**
     * @return User
     */
    public function getUser() : User;
}

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

use App\Interfaces\SmartFactPlanningInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Planning
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Planning implements SmartFactPlanningInterface
{
    /**
     * @var string
     *
     * @Groups({"users", "planning", "mmetup"})
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"users", "planning", "mmetup"})
     */
    private $period;

    /**
     * @var ArrayCollection
     *
     * @Groups({"users", "planning"})
     */
    private $meetups;

    /**
     * @var User
     *
     * @Groups({ "planning", "mmetup"})
     */
    private $user;

    /**
     * Planning constructor.
     */
    public function __construct()
    {
        $this->meetups = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getPeriod() : string
    {
        return $this->period;
    }

    /**
     * {@inheritdoc}
     */
    public function setPeriod(string $period)
    {
        $this->period = $period;
    }

    /**
     * {@inheritdoc}
     */
    public function addMeetup(Meetup $meetup)
    {
        $this->meetups[] = $meetup;
    }

    /**
     * {@inheritdoc}
     */
    public function removeMeetup(Meetup $meetup)
    {
        $this->meetups->removeElement($meetup);
    }

    /**
     * {@inheritdoc}
     */
    public function getMeetups() : ArrayCollection
    {
        return $this->meetups;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}

<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

// Interface
use App\Interfaces\SmartFactPlanningInterface;

/**
 * Class Planning
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_planning")
 * @ORM\Entity(repositoryClass="App\Repository\PlanningRepository")
 */
class Planning implements SmartFactPlanningInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="period", type="string", length=10)
     */
    private $period;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Meetup", mappedBy="planning")
     */
    private $meetup;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="planning")
     */
    private $user;

    /**
     * Planning constructor.
     */
    public function __construct()
    {
        $this->meetup = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @param Meetup $meetup
     */
    public function addMeetup(Meetup $meetup)
    {
        $this->meetup[] = $meetup;
    }

    /**
     * @param Meetup $meetup
     */
    public function removeMeetup(Meetup $meetup)
    {
        $this->meetup->removeElement($meetup);
    }

    /**
     * @return ArrayCollection
     */
    public function getMeetups()
    {
        return $this->meetup;
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
}

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
use AppBundle\Interfaces\SmartFactBillsInterface;

/**
 * Class Bills
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_bills")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BillsRepository")
 */
class Bills implements SmartFactBillsInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var bool
     *
     * @ORM\Column(name="send", type="boolean")
     */
    private $send;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="send_at", type="datetime")
     */
    private $sendAt;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=150)
     */
    private $file;

    /**
     * @var bool
     *
     * @ORM\Column(name="tva", type="boolean")
     */
    private $tva;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="bills")
     */
    private $user;

    /**
     * @var Clients
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Clients", inversedBy="bills")
     */
    private $clients;

    /**
     * Bills constructor.
     */
    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

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
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return bool
     */
    public function hasBeenSend()
    {
        return $this->send;
    }

    /**
     * @param bool $send
     */
    public function setSend($send)
    {
        $this->send = $send;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * @param \DateTime $sendAt
     */
    public function setSendAt($sendAt)
    {
        $this->sendAt = $sendAt;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @param bool $tva
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    }

    /**
     * @return bool
     */
    public function hasTva()
    {
        return $this->tva;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Clients $clients
     */
    public function addClients(Clients $clients)
    {
        $this->clients[] = $clients;
    }

    /**
     * @param Clients $clients
     */
    public function removeClients(Clients $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * @return Clients|ArrayCollection
     */
    public function getClients()
    {
        return $this->clients;
    }
}

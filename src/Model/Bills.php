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

use App\Interfaces\SmartFactBillsInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Bills
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Bills implements SmartFactBillsInterface
{
    /**
     * @var int
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $date;

    /**
     * @var float
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $total;

    /**
     * @var bool
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $send;

    /**
     * @var \DateTime
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $sendAt;

    /**
     * @var string
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $file;

    /**
     * @var bool
     *
     * @Groups({"personal", "users", "bills", "clients"})
     */
    private $tva;

    /**
     * @var User
     *
     * @Groups({"bills", "clients"})
     */
    private $user;

    /**
     * @var ArrayCollection
     *
     * @Groups({"users", "bills"})
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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * {@inheritdoc}
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
     * @return bool
     */
    public function getSend()
    {
        return $this->send;
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

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
     *
     * @throws \InvalidArgumentException
     */
    public function setDate($date)
    {
        if (!$date instanceof \DateTime) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t valid !
                        Givent %s,',
                    gettype($date)
                )
            );
        }

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
     *
     * @throws \InvalidArgumentException
     */
    public function setTotal($total)
    {
        if (!is_float($total)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t the right type !
                            Given %s',
                    gettype($total)
                )
            );
        }

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
     *
     * @throws \InvalidArgumentException
     */
    public function setSend($send)
    {
        if (!is_bool($send)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t the type expected !
                            Given %s',
                    gettype($send)
                )
            );
        }

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
     *
     * @throws \InvalidArgumentException
     */
    public function setSendAt($sendAt)
    {
        if (!$sendAt instanceof \DateTime) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t the type expected !
                            Given %s',
                    gettype($sendAt) || get_class($sendAt)
                )
            );
        }

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
     *
     * @throws \InvalidArgumentException
     */
    public function setFile($file)
    {
        if (!is_string($file)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t the right type of value expected !
                            Given %s',
                    gettype($file)
                )
            );
        }

        $this->file = $file;
    }

    /**
     * @param bool $tva
     *
     * @throws \InvalidArgumentException
     */
    public function setTva($tva)
    {
        if (!is_bool($tva)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value ins\'t the type expected !
                            Given %s',
                    gettype($tva)
                )
            );
        }

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
     *
     * @throws \InvalidArgumentException
     */
    public function setUser(User $user)
    {
        if (!$user instanceof User) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t the right instance or type !
                            Given %s',
                    gettype($user) || get_class($user)
                )
            );
        }
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
     *
     * @throws \InvalidArgumentException
     */
    public function addClients(Clients $clients)
    {
        if (!$clients instanceof Clients) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t the right instance or type !
                            Given %s',
                        gettype($clients) || get_class($clients)
                )
            );
        }

        $this->clients[] = $clients;
    }

    /**
     * @param Clients $clients
     *
     * @throws \InvalidArgumentException
     */
    public function removeClients(Clients $clients)
    {
        if (!$clients instanceof Clients) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This value isn\'t the right instance or type !
                            Given %s',
                    gettype($clients) || get_class($clients)
                )
            );
        }

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

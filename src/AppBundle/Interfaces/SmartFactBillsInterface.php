<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Interfaces;

use AppBundle\Entity\User;
use AppBundle\Entity\Clients;

/**
 * Interface SmartFactBillsInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactBillsInterface
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
     * @return float
     */
    public function getTotal();

    /**
     * @param float $total
     */
    public function setTotal($total);

    /**
     * @param bool $send
     */
    public function setSend($send);

    /**
     * @return bool
     */
    public function hasBeenSend();
    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $sendAt
     */
    public function setSendAt($sendAt);

    /**
     * @return \DateTime
     */
    public function getSendAt();

    /**
     * @param string $file
     */
    public function setFile($file);

    /**
     * @return string
     */
    public function getFile();

    /**
     * @param User $user
     */
    public function setUser(User $user);

    /**
     * @return User
     */
    public function getUser();

    /**
     * @param Clients $clients
     */
    public function addClients(Clients $clients);

    /**
     * @param Clients $clients
     */
    public function removeClients(Clients $clients);

    /**
     * @return Clients
     */
    public function getClients();
}

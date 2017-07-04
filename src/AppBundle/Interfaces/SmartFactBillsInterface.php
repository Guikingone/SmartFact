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
     *
     * @throws \InvalidArgumentException
     */
    public function setDate($date);

    /**
     * @return float
     */
    public function getTotal();

    /**
     * @param float $total
     *
     * @throws \InvalidArgumentException
     */
    public function setTotal($total);

    /**
     * @param bool $send
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
     */
    public function setSendAt($sendAt);

    /**
     * @return \DateTime
     */
    public function getSendAt();

    /**
     * @param string $file
     *
     * @throws \InvalidArgumentException
     */
    public function setFile($file);

    /**
     * @return string
     */
    public function getFile();

    /**
     * @param User $user
     *
     * @throws \InvalidArgumentException
     */
    public function setUser(User $user);

    /**
     * @return User
     */
    public function getUser();

    /**
     * @param Clients $clients
     *
     * @throws \InvalidArgumentException
     */
    public function addClients(Clients $clients);

    /**
     * @param Clients $clients
     *
     * @throws \InvalidArgumentException
     */
    public function removeClients(Clients $clients);

    /**
     * @return Clients
     */
    public function getClients();
}

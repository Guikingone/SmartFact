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
use App\Model\Bills;
use App\Model\Meetup;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface SmartFactClientsInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactClientsInterface
{
    /**
     * @return null|int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getAddress() : string;

    /**
     * @param string $address
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getPhoneNumber() : string;

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * @return string
     */
    public function getPrestationType() : string;

    /**
     * @param string $prestationType
     */
    public function setPrestationType($prestationType);

    /**
     * @return User
     */
    public function getUser() : User;

    /**
     * @param User $user
     *
     * @throws \InvalidArgumentException
     */
    public function setUser(User $user);

    /**
     * @param Bills $bills
     * @return mixed
     */
    public function addBills(Bills $bills);

    /**
     * @param Bills $bills
     * @return mixed
     */
    public function removeBills(Bills $bills);

    /**
     * @return Bills
     */
    public function getBills() : ArrayCollection;

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
     * @return Meetup
     */
    public function getMeetups() : ArrayCollection;
}

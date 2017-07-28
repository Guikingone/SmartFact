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

/**
 * Interface SmartFactAccountingInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactAccountingInterface
{
    /**
     * @return null|int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getInterlocutor();

    /**
     * @param string $interlocutor
     *
     * @return mixed
     */
    public function setInterlocutor(string $interlocutor);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     * @return mixed
     */
    public function setAddress(string $address);

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @param string $phoneNumber
     * @return mixed
     */
    public function setPhoneNumber(string $phoneNumber);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return mixed
     */
    public function setEmail(string $email);

    /**
     * @param User $user
     * @return mixed
     */
    public function addUser(User $user);

    /**
     * @param User $user
     * @return mixed
     */
    public function removeUser(User $user);

    /**
     * @return User
     */
    public function getUser();
}

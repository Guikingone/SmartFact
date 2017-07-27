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

/**
 * Interface SmartFactClientsInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactClientsInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * @return string
     */
    public function getPrestationType();

    /**
     * @param string $prestationType
     */
    public function setPrestationType($prestationType);

    /**
     * @return User
     */
    public function getUser();

    /**
     * @param User $user
     *
     * @throws \InvalidArgumentException
     */
    public function setUser(User $user);
}

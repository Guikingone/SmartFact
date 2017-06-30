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
     *
     * @throws \InvalidArgumentException    If the value isn't correct or too long.
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     *
     * @throws \InvalidArgumentException
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @param string $phoneNumber
     *
     * @throws \InvalidArgumentException
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * @return string
     */
    public function getPrestationType();

    /**
     * @param string $prestationType
     *
     * @throws \InvalidArgumentException
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

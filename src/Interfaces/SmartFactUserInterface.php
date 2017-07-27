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

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Interface SmartFactUserInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactUserInterface extends AdvancedUserInterface, \Serializable
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @param string $firstname
     */
    public function setFirstname($firstName);

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @param string $lastname
     */
    public function setLastname($lastName);

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
     * @return \DateTime
     */
    public function getBirthDate();

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     */
    public function setStatus($status);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @return bool
     */
    public function getValidated();

    /**
     * @param bool $validated
     */
    public function setValidated($validated);

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $username
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $password
     */
    public function setPassword($password);

    /**
     * @return string
     */
    public function getPlainPassword();

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param string $token
     */
    public function setToken($token);

    /**
     * @return array
     */
    public function getRoles();

    /**
     * @param array $roles
     */
    public function setRoles($roles);

    /**
     * @param string $roles
     */
    public function addRoles($roles);
}

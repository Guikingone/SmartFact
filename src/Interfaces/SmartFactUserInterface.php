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

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Interface SmartFactUserInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactUserInterface extends AdvancedUserInterface, \Serializable
{
    /**
     * @return null|int
     */
    public function getId();

    /**
     * @return string
     */
    public function getFirstname() : string;

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstName);

    /**
     * @return string
     */
    public function getLastname() : string;

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastName);

    /**
     * @return string
     */
    public function getAddress() : string;

    /**
     * @param string $address
     */
    public function setAddress(string $address);

    /**
     * @return string
     */
    public function getPhoneNumber() : string;

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber);

    /**
     * @return \DateTime
     */
    public function getBirthDate() : \DateTime;

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate);

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
     * @param string $email
     * @return mixed
     */
    public function setEmail(string $email);

    /**
     * @return string
     */
    public function getEmail();

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

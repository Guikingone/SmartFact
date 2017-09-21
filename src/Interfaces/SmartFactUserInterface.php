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
    public function getFirstName();

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     */
    public function setAddress(string $address);

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber);

    /**
     * @return \DateTime
     */
    public function getBirthDate();

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
    public function setPassword(string $password);

    /**
     * @return string
     */
    public function getPlainPassword();

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param string $token
     */
    public function setToken(string $token);

    /**
     * @return string
     */
    public function getRoles();

    /**
     * @param string $roles
     */
    public function setRoles(string $roles);

    /**
     * @return string
     */
    public function getScope();

    /**
     * @param string $scope
     */
    public function setScope(string $scope);

    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $state
     */
    public function setState(string $state);
}

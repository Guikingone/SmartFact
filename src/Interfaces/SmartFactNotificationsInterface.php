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

// Entity
use App\Entity\User;

/**
 * Interface SmartFactNotificationsInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactNotificationsInterface
{
    /** @return int */
    public function getId();

    /** @return string */
    public function getName();

    /** @param string $name */
    public function setName($name);

    /** @return string */
    public function getCategory();

    /** @param string $category */
    public function setCategory($category);

    /** @return \DateTime */
    public function getCreatedAt();

    /** @param \Datetime $createdAt */
    public function setCreatedAt($createdAt);

    /** @return string */
    public function getLink();

    /** @param string $link */
    public function setLink($link);

    /** @return string */
    public function getContent();

    /** @param string $content */
    public function setContent($content);

    /** @return bool */
    public function hasRepetition();

    /** @param bool $repetition */
    public function setRepetition($repetition);

    /** @return bool */
    public function hasBeenChecked();

    /** @param bool $checked */
    public function setChecked($checked);

    /** @return User */
    public function getUser();

    /** @param User $user */
    public function setUser(User $user);
}

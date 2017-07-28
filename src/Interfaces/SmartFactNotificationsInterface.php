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
 * Interface SmartFactNotificationsInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactNotificationsInterface
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
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getCategory() : string;

    /**
     * @param string $category
     * @return mixed
     */
    public function setCategory(string $category);

    /**
     * @return \DateTime
     */
    public function getCreatedAt() : \DateTime;

    /**
     * @param $createdAt
     * @return mixed
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @return string
     */
    public function getLink() : string;

    /**
     * @param string $link
     * @return mixed
     */
    public function setLink(string $link);

    /**
     * @return string
     */
    public function getContent() : string;

    /**
     * @param string $content
     * @return mixed
     */
    public function setContent(string $content);

    /**
     * @return bool
     */
    public function hasRepetition() : bool;

    /**
     * @param bool $repetition
     * @return mixed
     */
    public function setRepetition(bool $repetition);

    /**
     * @return bool
     */
    public function hasBeenChecked() : bool;

    /**
     * @param bool $checked
     * @return mixed
     */
    public function setChecked(bool $checked);

    /**
     * @return User
     */
    public function getUser() : User;

    /**
     * @param User $user
     * @return mixed
     */
    public function setUser(User $user);
}

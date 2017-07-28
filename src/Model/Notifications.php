<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Model;

use App\Interfaces\SmartFactNotificationsInterface;

/**
 * Class Notifications
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Notifications implements SmartFactNotificationsInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $category;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $repetition;

    /**
     * @var bool
     */
    private $checked;

    /**
     * @var User
     */
    private $user;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory() : string
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getLink() : string
    {
        return $this->link;
    }

    /**
     * {@inheritdoc}
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function hasRepetition() : bool
    {
        return $this->repetition;
    }

    /**
     * {@inheritdoc}
     */
    public function setRepetition(bool $repetition)
    {
        $this->repetition = $repetition;
    }

    /**
     * {@inheritdoc}
     */
    public function hasBeenChecked() : bool
    {
        return $this->checked;
    }

    /**
     * {@inheritdoc}
     */
    public function setChecked(bool $checked)
    {
        $this->checked = $checked;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser() : User
    {
        return $this->user;
    }
}

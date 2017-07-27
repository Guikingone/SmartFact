<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

// Core
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

// Interface
use AppBundle\Interfaces\SmartFactNotificationsInterface;

/**
 * Class Notifications
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_notifications")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotificationsRepository")
 */
class Notifications implements SmartFactNotificationsInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=50)
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string")
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string")
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="repetition", type="boolean")
     */
    private $repetition;

    /**
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean")
     */
    private $checked;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="notifications")
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function hasRepetition()
    {
        return $this->repetition;
    }

    /**
     * @param bool $repetition
     */
    public function setRepetition($repetition)
    {
        $this->repetition = $repetition;
    }

    /**
     * @return bool
     */
    public function hasBeenChecked()
    {
        return $this->checked;
    }

    /**
     * @param bool $checked
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Notifications
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}

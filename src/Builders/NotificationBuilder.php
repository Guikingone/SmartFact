<?php

declare(strict_types=1);

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Builders;

use App\Models\Interfaces\UserInterface;
use App\Interactors\NotificationInteractor;
use App\Models\Interfaces\NotificationInterface;
use App\Builders\Interfaces\NotificationBuilderInterface;

/**
 * Class NotificationBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationBuilder implements NotificationBuilderInterface
{
    /**
     * @var NotificationInterface
     */
    private $notification;

    /**
     * {@inheritdoc}
     */
    public function create(): NotificationBuilderInterface
    {
        $this->notification = new NotificationInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setNotification(NotificationInterface $notification): NotificationBuilderInterface
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLabel(string $label): NotificationBuilderInterface
    {
        $this->notification->setLabel($label);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withContent(string $content): NotificationBuilderInterface
    {
        $this->notification->setContent($content);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withTags(array $tags): NotificationBuilderInterface
    {
        $this->notification->addTags($tags);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUser(UserInterface $user): NotificationBuilderInterface
    {
        $this->notification->setUser($user);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): NotificationInterface
    {
        return $this->notification;
    }
}

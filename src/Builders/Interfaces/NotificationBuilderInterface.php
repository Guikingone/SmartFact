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

namespace App\Builders\Interfaces;

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\NotificationInterface;

/**
 * Interface NotificationBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface NotificationBuilderInterface
{
    /**
     * @return NotificationBuilderInterface
     */
    public function create(): NotificationBuilderInterface;

    /**
     * @param NotificationInterface $notification
     *
     * @return NotificationBuilderInterface
     */
    public function setNotification(NotificationInterface $notification): NotificationBuilderInterface;

    /**
     * @param string $label
     *
     * @return NotificationBuilderInterface
     */
    public function withLabel(string $label): NotificationBuilderInterface;

    /**
     * @param string $content
     *
     * @return NotificationBuilderInterface
     */
    public function withContent(string $content): NotificationBuilderInterface;

    /**
     * @param array $tags
     *
     * @return NotificationBuilderInterface
     */
    public function withTags(array $tags): NotificationBuilderInterface;

    /**
     * @param UserInterface $user
     *
     * @return NotificationBuilderInterface
     */
    public function withUser(UserInterface $user): NotificationBuilderInterface;

    /**
     * @return NotificationInterface
     */
    public function build(): NotificationInterface;
}

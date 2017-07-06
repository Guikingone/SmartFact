<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\services;

use AppBundle\Entity\Notifications;

/**
 * Class NotificationGenerator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationGenerator
{
    /**
     * Allow to generate a new Notification.
     *
     * @param object $position
     * @param string $title
     * @param string $category
     * @param string $content
     *
     * @throws \InvalidArgumentException
     */
    public function generateNotification($position, $title, $category, $content)
    {
        if (!is_object($position)) {
            throw new \InvalidArgumentException(
                sprintf(
                    ''
                )
            );
        }

    }
}
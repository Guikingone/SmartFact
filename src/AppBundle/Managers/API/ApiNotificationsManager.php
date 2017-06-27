<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Managers\API;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;

// Entity
use AppBundle\Entity\Notifications;

/**
 * Class ApiNotificationsManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiNotificationsManager
{
    /** @var EntityManager */
    private $doctrine;

    /** @var Serializer */
    private $serializer;

    /**
     * ApiNotificationsManager constructor.
     *
     * @param EntityManager $doctrine
     * @param Serializer $serializer
     */
    public function __construct(
        EntityManager $doctrine,
        Serializer $serializer
    ) {
        $this->doctrine = $doctrine;
        $this->serializer = $serializer;
    }

    /**
     * Return the User notifications.
     *
     * @param int $id   The id of the User.
     *
     * @return array|null   The array of Notifications if available, null if not.
     */
    public function getUserNotifications($id)
    {
        $data = $this->doctrine->getRepository(Notifications::class)
                               ->findBy([
                                   'user' => $id
                               ]);

        if (!$data) {
            return null;
        }

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['notifications']]
        );
    }

    /**
     * Return a single Notification using both
     * User id and Notification id.
     *
     * @param int $id               The User id.
     * @param int $notificationId   The Notification id.
     *
     * @return array|null   The array of Notification if available, null if not.
     */
    public function getUserSingleNotification($id, $notificationId)
    {
        $data = $this->doctrine->getRepository(Notifications::class)
                               ->findBy([
                                   'user' => $id,
                                   'id' => $notificationId
                               ]);

        if (!$data) {
            return null;
        }

        return $this->serializer->serialize(
            $data,
            'json'
        );
    }

    public function postUserNotification($data)
    {

    }
}

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

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

// Entity
use AppBundle\Entity\Notifications;

/**
 * Class ApiNotificationsManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiNotificationsManager
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var EntityManagerInterface */
    private $doctrine;

    /**
     * ApiNotificationsManager constructor.
     *
     * @param EntityManagerInterface $doctrine
     * @param SerializerInterface $serializer
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        SerializerInterface $serializer
    ) {
        $this->doctrine = $doctrine;
        $this->serializer = $serializer;
    }

    /**
     * Return the User Notifications using the User id.
     *
     * @param int $id       The User id.
     *
     * @return string|array The array of Notifications.
     */
    public function getUserNotifications($id)
    {
        $data = $this->doctrine->getRepository(Notifications::class)
                               ->findBy([
                                   'user' => $id
                               ]);

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
     * @return string   The string of Notification if available, null if not.
     */
    public function getUserSingleNotification($id, $notificationId)
    {
        $data = $this->doctrine->getRepository(Notifications::class)
                               ->findBy([
                                   'user' => $id,
                                   'id' => $notificationId
                               ]);

        return $this->serializer->serialize(
            $data,
            'json'
        );
    }

    public function postUserNotification($data)
    {
        $object = $this->serializer->deserialize(
            $data,
            Notifications::class,
            'json'
        );

        $this->doctrine->persist($object);
        $this->doctrine->flush();

        return $object;
    }

    /**
     * Delete the User Notifications.
     *
     * @param int $id   The id of the User who's been linked to the Notifications.
     */
    public function deleteUserNotifications($id)
    {
        $notifications = $this->doctrine->getRepository(Notifications::class)
                                        ->findBy([
                                            'user' => $id
                                        ]);

        foreach ($notifications as $notification) {
            $this->doctrine->remove($notification);
        }
        $this->doctrine->flush();
    }
}

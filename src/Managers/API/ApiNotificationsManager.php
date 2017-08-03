<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Managers\API;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

// Entity
use App\Resolvers\Notifications;

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

    /** @var ValidatorInterface */
    private $validator;

    /**
     * ApiNotificationsManager constructor.
     *
     * @param SerializerInterface       $serializer
     * @param EntityManagerInterface    $doctrine
     * @param ValidatorInterface        $validator
     */
    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $doctrine,
        ValidatorInterface $validator
    ) {
        $this->serializer = $serializer;
        $this->doctrine = $doctrine;
        $this->validator = $validator;
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
                                   'users' => $id
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
                                   'users' => $id,
                                   'id' => $notificationId
                               ]);

        return $this->serializer->serialize(
            $data,
            'json'
        );
    }

    /**
     * Allow to create a new Notifications.
     *
     * @param string|array $data    The data who's gonna create the notification.
     *
     * @return object|\Symfony\Component\Validator\ConstraintViolationListInterface
     */
    public function postUserNotification($data)
    {
        $object = $this->serializer->deserialize(
            $data,
            Notifications::class,
            'json'
        );

        if ($errors = $this->validator->validate($object)) {
            return $errors;
        }

        $this->doctrine->persist($object);
        $this->doctrine->flush();

        return $object;
    }

    public function patchUserNotification($data)
    {

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
                                            'users' => $id
                                        ]);

        foreach ($notifications as $notification) {
            $this->doctrine->remove($notification);
        }
        $this->doctrine->flush();
    }
}

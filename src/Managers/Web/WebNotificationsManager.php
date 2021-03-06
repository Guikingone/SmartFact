<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Managers\Web;

// Entity
use App\Model\User;
use App\Model\Notifications;

// Event
use App\Events\Notifications\DeletedNotificationEvent;

// Core
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class WebNotificationsManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebNotificationsManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $form;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * WebNotificationsManager constructor.
     *
     * @param EntityManager               $entityManager
     * @param FormFactoryInterface          $form
     * @param EventDispatcherInterface      $eventDispatcher
     */
    public function __construct(
        EntityManager $entityManager,
        FormFactoryInterface $form,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager = $entityManager;
        $this->form = $form;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Allow to return all the Notifications linked to an User.
     *
     * @param int $userId                   The id of the User.
     *
     * @return Notifications[]|array
     */
    public function getNotificationsByUser(int $userId)
    {
        return $this->entityManager->getRepository(Notifications::class)
                                     ->findBy([
                                         'users' => $userId
                                     ]);
    }

    /**
     * Allow to return a single Notifications using hid id and the User id.
     *
     * @param int $userId
     * @param int $id
     *
     * @throws \InvalidArgumentException
     *
     * @return Notifications|null|object
     */
    public function getSingleNotificationsByUser(int $userId, int $id)
    {
        $notification =  $this->entityManager->getRepository(Notifications::class)
                                               ->findOneBy([
                                                   'users' => $userId,
                                                   'id' => $id
                                               ]);

        if (!$notification) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This identifier doesn\'t exist !
                            Given %s',
                    $id
                )
            );
        }

        return $notification;
    }

    public function postNewNotification(int $userId)
    {
        if (!is_int($userId)) {
            throw new \InvalidArgumentException(
                \sprintf(
                    'This value isn\'t valid !
                            Given %s, expected integer.',
                    \gettype($userId)
                )
            );
        }

        $user = $this->entityManager->getRepository(User::class)
                                      ->findOneBy([
                                          'id' => $userId
                                      ]);

        if (!$user) {
            throw new \LogicException(
                sprintf(
                    'A User should be found using the identifier passed !
                            Given %s',
                    $user
                )
            );
        }
    }

    /**
     * Allow to delete a single Notification linked to an User.
     *
     * @param int $user                     The id of the User.
     * @param int $id                       The id of the Notifications.
     *
     * @throws \InvalidArgumentException    If the argument aren't valid.
     * @throws \LogicException              If the DB doesn't return results.
     */
    public function deleteSingleNotificationByUser($user, $id)
    {
        if ((!is_int($user)) || (!is_int($id))) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The values passed aren\'t in the good format !
                            Given %s, expected integer !',
                    gettype([$user, $id])
                )
            );
        }

        $notification = $this->entityManager->getRepository(Notifications::class)
                                              ->findOneBy([
                                                  'users' => $user,
                                                  'id' => $id
                                              ]);

        if (!$notification) {
            throw new \LogicException(
                sprintf(
                    'The values passed doesn\'t return any data !
                            Given %s',
                    $user && $id
                )
            );
        }

        $this->entityManager->remove($notification);
        $this->entityManager->flush();
    }

    /**
     * Allow to delete all the Notifications linked to an User.
     *
     * @param int $user                     The id of the User.
     *
     * @throws \InvalidArgumentException    If the users param isn't a integer.
     * @throws \InvalidArgumentException    If no notifications has been found.
     */
    public function deleteNotificationsByUser($user)
    {
        if (!is_int($user)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'This identifier doesn\'t exist !
                            Given %s',
                    $user
                )
            );
        }

        $notifications = $this->entityManager->getRepository(Notifications::class)
                                               ->findBy([
                                                   'users' => $user
                                               ]);

        if (!$notifications) {
            throw new \InvalidArgumentException(
                sprintf(
                    'No data has been found, please check the identifier, 
                            given %s',
                    $user
                )
            );
        }

        foreach ($notifications as $notification) {
            $event = new DeletedNotificationEvent($notification);
            $this->eventDispatcher->dispatch(
                DeletedNotificationEvent::NAME,
                $event
            );

            $this->entityManager->remove($notification);
        }

        $this->entityManager->flush();
    }
}

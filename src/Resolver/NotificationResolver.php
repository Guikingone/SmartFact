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

namespace App\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use App\Interactors\NotificationInteractor;
use App\Resolver\Interfaces\NotificationResolverInterface;

/**
 * Class NotificationResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationResolver implements NotificationResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * NotificationResolver constructor.
     *
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotifications(\ArrayAccess $arguments): array
    {
        if ($id = $arguments->offsetGet('id')) {
            return [
                $this->entityManagerInterface
                     ->getRepository(NotificationInteractor::class)
                     ->findOneBy([
                         'id' => $id
                     ])
            ];
        } elseif ($userId = $arguments->offsetGet('user_id')) {
            return [
                $this->entityManagerInterface
                    ->getRepository(NotificationInteractor::class)
                    ->findOneBy([
                        'user' => $userId
                    ])
            ];
        }

        return [
            $this->entityManagerInterface
                 ->getRepository(NotificationInteractor::class)
                 ->findAll()
        ];
    }
}

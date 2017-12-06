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
        switch ($arguments) {
            case $arguments->offsetExists('id') && $arguments->offsetExists('userId'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(NotificationInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id'),
                             'user' => (int) $arguments->offsetGet('userId')
                         ])
                ];
                break;
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(NotificationInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id')
                         ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(NotificationInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

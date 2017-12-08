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

use App\Interactors\UserInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolver\Interfaces\UserResolverInterface;

/**
 * Class UserResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserResolver implements UserResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * UserResolver constructor.
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
    public function getUsers(\ArrayAccess $arguments): array
    {
        switch ($arguments) {
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(UserInteractor::class)
                         ->findOneBy([
                             'id' => $arguments->offsetGet('id')
                         ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(UserInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

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

use App\Interactors\ImageInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolver\Interfaces\ImageResolverInterface;

/**
 * Class ImageResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ImageResolver implements ImageResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * ImageResolver constructor.
     * *
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages(\ArrayAccess $arguments): array
    {
        switch ($arguments) {
            case $arguments->offsetExists('id') && $arguments->offsetExists('name'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(ImageInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id'),
                             'name' => (string) $arguments->offsetGet('name')
                         ])
                ];
                break;
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(ImageInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id')
                         ])
                ];
                break;
            case $arguments->offsetExists('name'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(ImageInteractor::class)
                         ->findOneBy([
                             'name' => (string) $arguments->offsetGet('name')
                         ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(ImageInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

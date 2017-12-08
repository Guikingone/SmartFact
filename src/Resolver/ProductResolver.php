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

use App\Interactors\ProductInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolver\Interfaces\ProductResolverInterface;

/**
 * Class ProductResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ProductResolver implements ProductResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * ProductResolver constructor.
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
    public function getProducts(\ArrayAccess $arguments): array
    {
        switch ($arguments) {
            case $arguments->offsetExists('id') && $arguments->offsetExists('type'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(ProductInteractor::class)
                         ->findOneBy([
                             'id' => (int)  $arguments->offsetGet('id'),
                             'type' => (string) $arguments->offsetGet('type')
                         ])
                ];
                break;
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(ProductInteractor::class)
                         ->findOneBy([
                             'id' => (int)  $arguments->offsetGet('id')
                         ])
                ];
                break;
            case $arguments->offsetExists('type'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(ProductInteractor::class)
                         ->findOneBy([
                             'type' => (string) $arguments->offsetGet('type')
                         ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(ProductInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

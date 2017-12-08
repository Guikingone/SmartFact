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

use App\Interactors\BillsInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolver\Interfaces\BillsResolverInterface;

/**
 * Class BillsResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class BillsResolver implements BillsResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * BillsResolver constructor.
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
    public function getBills(\ArrayAccess $arguments): array
    {
        switch ($arguments) {
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(BillsInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id')
                         ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(BillsInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

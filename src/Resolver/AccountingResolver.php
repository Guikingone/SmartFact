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
use App\Interactors\AccountingInteractor;
use App\Resolver\Interfaces\AccountingResolverInterface;

/**
 * Class AccountingResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class AccountingResolver implements AccountingResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * AccountingResolver constructor.
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
    public function getAccountings(\ArrayAccess $arguments): array
    {
        switch ($arguments) {
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(AccountingInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id')
                         ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(AccountingInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

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

use App\Interactors\CompanyInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolver\Interfaces\CompanyResolverInterface;

/**
 * Class CompanyResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CompanyResolver implements CompanyResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * CompanyResolver constructor.
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
    public function getCompanies(\ArrayAccess $arguments): array
    {
        switch ($arguments) {
            case $arguments->offsetExists('id') && $arguments->offsetExists('name'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(CompanyInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id'),
                             'name' => (string) $arguments->offsetGet('name')
                         ])
                ];
                break;
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(CompanyInteractor::class)
                         ->findOneBy([
                             'id' => (int) $arguments->offsetGet('id')
                         ])
                ];
                break;
            case $arguments->offsetExists('name'):
                return [
                    $this->entityManagerInterface
                         ->getRepository(CompanyInteractor::class)
                         ->findOneBy([
                             'name' => (int) $arguments->offsetGet('name')
                         ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(CompanyInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

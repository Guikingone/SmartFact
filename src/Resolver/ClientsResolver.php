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

use App\Interactors\ClientInteractor;
use Doctrine\ORM\EntityManagerInterface;
use App\Resolver\Interfaces\ClientsResolverInterface;

/**
 * Class ClientsResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ClientsResolver implements ClientsResolverInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * ClientsResolver constructor.
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
    public function getClients(\ArrayAccess $arguments): array
    {
        switch ($arguments) {
            case $arguments->offsetExists('id') && $arguments->offsetExists('firstName'):
                return [
                    $this->entityManagerInterface
                        ->getRepository(ClientInteractor::class)
                        ->findOneBy([
                            'id' => (int) $arguments->offsetGet('id'),
                            'firstName' => (string) $arguments->offsetGet('firstName')
                        ])
                ];
                break;
            case $arguments->offsetExists('id'):
                return [
                    $this->entityManagerInterface
                        ->getRepository(ClientInteractor::class)
                        ->findOneBy([
                            'id' => (int) $arguments->offsetGet('id')
                        ])
                ];
                break;
            case $arguments->offsetExists('firstName'):
                return [
                    $this->entityManagerInterface
                        ->getRepository(ClientInteractor::class)
                        ->findOneBy([
                            'firstName' => (string) $arguments->offsetGet('firstName')
                        ])
                ];
                break;
            default:
                return [
                    $this->entityManagerInterface
                         ->getRepository(ClientInteractor::class)
                         ->findAll()
                ];
                break;
        }
    }
}

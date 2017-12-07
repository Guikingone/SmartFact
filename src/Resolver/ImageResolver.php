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
        // TODO: Implement getImages() method.
    }
}

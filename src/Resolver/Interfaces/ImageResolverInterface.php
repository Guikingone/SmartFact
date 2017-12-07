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

namespace App\Resolver\Interfaces;

/**
 * Interface ImageResolverInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ImageResolverInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments required to fetch Image.
     *
     * @return array                     The array of Image.
     */
    public function getImages(\ArrayAccess $arguments): array;
}

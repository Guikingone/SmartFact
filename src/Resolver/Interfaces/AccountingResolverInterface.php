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
 * Interface AccountingResolverInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface AccountingResolverInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments defined with the schema.
     *
     * @return array                     The array which contain the entries.
     */
    public function getAccountings(\ArrayAccess $arguments): array;
}

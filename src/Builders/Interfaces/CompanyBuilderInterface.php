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

namespace App\Builders\Interfaces;

use App\Models\Interfaces\CompanyInterface;

/**
 * Interface CompanyBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface CompanyBuilderInterface
{
    /**
     * @return CompanyBuilderInterface
     */
    public function create(): CompanyBuilderInterface;

    /**
     * @return CompanyInterface
     */
    public function build(): CompanyInterface;
}

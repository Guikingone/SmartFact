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

namespace App\Models\Interfaces;

/**
 * Interface CompanyInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface CompanyInterface
{
    /**
     * @return int|null
     */
    public function getId():? int;
}

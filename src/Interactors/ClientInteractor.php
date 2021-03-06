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

namespace App\Interactors;

use App\Models\Client;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ClientInteractor
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ClientInteractor extends Client
{
    /**
     * ClientInteractor constructor.
     */
    public function __construct()
    {
        $this->bills = new ArrayCollection();
    }
}

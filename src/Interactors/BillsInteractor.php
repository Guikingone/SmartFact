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

use App\Models\Bills;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class BillsInteractor
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BillsInteractor extends Bills
{
    /**
     * BillsInteractor constructor.
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
}

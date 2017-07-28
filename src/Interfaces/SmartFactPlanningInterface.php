<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Interfaces;

/**
 * Interface SmartFactPlanningInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactPlanningInterface
{
    /**
     * @return null|int
     */
    public function getId();

    /**
     * @return string
     */
    public function getPeriod() : string;

    /**
     * @param string $period
     * @return mixed
     */
    public function setPeriod(string $period);
}

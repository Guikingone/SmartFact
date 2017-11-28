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

namespace App\Builders;

use App\Interactors\CompanyInteractor;
use App\Models\Interfaces\CompanyInterface;
use App\Builders\Interfaces\CompanyBuilderInterface;

/**
 * Class CompanyBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class CompanyBuilder implements CompanyBuilderInterface
{
    /**
     * @var CompanyInterface
     */
    private $company;

    /**
     * {@inheritdoc}
     */
    public function create(): CompanyBuilderInterface
    {
        $this->company = new CompanyInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): CompanyInterface
    {
        return $this->company;
    }
}

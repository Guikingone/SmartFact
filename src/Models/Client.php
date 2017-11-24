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

namespace App\Models;

use App\Models\Interfaces\ClientInterface;

/**
 * Class Client
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Client implements ClientInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * {@inheritdoc}
     */
    public function getId():? int
    {
        return $this->id;
    }
}

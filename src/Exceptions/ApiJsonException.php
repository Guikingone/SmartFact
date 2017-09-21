<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Exceptions;

use Throwable;

/**
 * Class ApiJsonException
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiJsonException extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

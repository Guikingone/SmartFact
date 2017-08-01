<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Security;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiTokenAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiTokenAction
{
    public function __construct()
    {

    }

    public function __invoke()
    {
        return new JsonResponse(
            'Hello World !'
        );
    }
}

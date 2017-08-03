<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Exceptions\Listeners;

use App\Exceptions\ApiJsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Class ExceptionsListener
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ExceptionsListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof ApiJsonException) {
            $response = new JsonResponse(
                [
                    'message' => $exception->getMessage()
                ]
            );
            $event->setResponse($response);
        }
    }
}

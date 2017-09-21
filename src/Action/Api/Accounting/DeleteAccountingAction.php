<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Accounting;

use App\Managers\API\ApiAccountingManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class DeleteAccountingAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class DeleteAccountingAction
{
    /**
     * @var ApiAccountingManager
     */
    private $manager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * DeleteAccountingAction constructor.
     *
     * @param ApiAccountingManager      $manager
     * @param RequestStack              $requestStack
     */
    public function __construct(
        ApiAccountingManager $manager,
        RequestStack $requestStack
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke() : JsonResponse
    {
        $id = $this->requestStack->getCurrentRequest()->attributes->get('id');

        $message = $this->manager->deleteAccounting($id);

        return new JsonResponse(
            $message,
            Response::HTTP_ACCEPTED
        );
    }
}

<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Bills;

use App\Managers\API\ApiBillsManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class DeleteBillsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class DeleteBillsAction
{
    /**
     * @var ApiBillsManager
     */
    private $manager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * DeleteBillsAction constructor.
     *
     * @param ApiBillsManager         $manager
     * @param RequestStack            $requestStack
     */
    public function __construct(
        ApiBillsManager $manager,
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
        $id = $this->requestStack->getCurrentRequest()->get('id');

        $this->manager->deleteBills($id);

        return new JsonResponse(
            [
                'message' => 'Resource deleted.'
            ],
            JsonResponse::HTTP_ACCEPTED
        );
    }
}

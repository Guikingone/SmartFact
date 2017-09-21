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

use Twig\Environment;
use App\Managers\API\ApiBillsManager;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetPersonalBillsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GetPersonalBillsAction
{
    /**
     * @var ApiBillsManager
     */
    private $manager;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * GetPersonalBillsAction constructor.
     *
     * @param ApiBillsManager       $manager
     * @param Environment           $twig
     */
    public function __construct(
        ApiBillsManager $manager,
        Environment $twig
    ) {
        $this->manager = $manager;
        $this->twig = $twig;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke() : JsonResponse
    {

    }
}

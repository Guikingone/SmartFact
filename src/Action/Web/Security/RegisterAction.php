<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Web\Security;

use App\Managers\Web\WebUserManager;

// Core
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class RegisterAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterAction
{
    /** @var WebUserManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /** @var Environment */
    private $templating;

    /**
     * RegisterAction constructor.
     *
     * @param WebUserManager        $manager
     * @param RequestStack          $requestStack
     * @param Environment           $engine
     */
    public function __construct(
        WebUserManager $manager,
        RequestStack $requestStack,
        Environment $engine
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
        $this->templating = $engine;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();

        $form = $this->manager->postUser($request);

        return new Response(
            $this->templating->render('security/register.html.twig', [
                'form' => $form
            ])
        );
    }
}

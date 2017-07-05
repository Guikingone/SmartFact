<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Web\Security;

use AppBundle\Managers\Web\WebUserManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class RegisterAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/register", name="registration")
 * @Method({"GET", "POST"})
 */
class RegisterAction
{
    /** @var WebUserManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /** @var EngineInterface */
    private $templating;

    /**
     * RegisterAction constructor.
     *
     * @param WebUserManager        $manager
     * @param RequestStack          $requestStack
     * @param EngineInterface       $engine
     */
    public function __construct(
        WebUserManager $manager,
        RequestStack $requestStack,
        EngineInterface $engine
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

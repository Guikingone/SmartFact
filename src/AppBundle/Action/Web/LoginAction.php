<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Web;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/login", name="login")
 *
 * @Method({"GET", "POST"})
 */
class LoginAction
{
    /** @var EngineInterface */
    private $templating;

    /** @var AuthenticationUtils */
    private $authentication;

    /**
     * LoginAction constructor.
     *
     * @param EngineInterface       $engine
     * @param AuthenticationUtils   $utils
     */
    public function __construct(
        EngineInterface $engine,
        AuthenticationUtils $utils
    ) {
        $this->templating = $engine;
        $this->authentication = $utils;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response(
            $this->templating->render(':security:login.html.twig', [
                'last_username' => $this->authentication->getLastUsername(),
                'errors' => $this->authentication->getLastAuthenticationError()
            ])
        );
    }
}

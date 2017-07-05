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

use AppBundle\Form\Type\LoginType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
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

    /** @var FormFactoryInterface */
    private $form;

    /** @var AuthenticationUtils */
    private $authentication;

    /**
     * LoginAction constructor.
     *
     * @param EngineInterface       $engine
     * @param FormFactoryInterface  $formFactory
     * @param AuthenticationUtils   $utils
     */
    public function __construct(
        EngineInterface $engine,
        FormFactoryInterface $formFactory,
        AuthenticationUtils $utils
    ) {
        $this->templating = $engine;
        $this->form = $formFactory;
        $this->authentication = $utils;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $form = $this->form->create(LoginType::class, [
            '_username' => $this->authentication->getLastUsername()
        ]);

        return new Response(
            $this->templating->render(':security:login.html.twig', [
                'form' => $form->createView(),
                'errors' => $this->authentication->getLastAuthenticationError()
            ])
        );
    }
}

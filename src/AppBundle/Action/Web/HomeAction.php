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

/**
 * Class HomeAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/", name="homepage")
 */
final class HomeAction
{
    /** @var EngineInterface */
    private $twig;

    /**
     * HomeAction constructor.
     *
     * @param EngineInterface $twig
     */
    public function __construct(
        EngineInterface $twig
    ) {
        $this->twig = $twig;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response(
            $this->twig->render('default/index.html.twig')
        );
    }
}

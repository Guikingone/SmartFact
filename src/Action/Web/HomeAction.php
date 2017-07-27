<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Web;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class HomeAction
{
    /** @var Environment */
    private $twig;

    /**
     * HomeAction constructor.
     *
     * @param Environment $twig
     */
    public function __construct(
        Environment $twig
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

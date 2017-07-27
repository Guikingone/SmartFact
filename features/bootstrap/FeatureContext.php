<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class FeatureContext
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class FeatureContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Response|null
     */
    private $response;

    /**
     * FeatureContext constructor.
     *
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given i send a request to :path using :method method.
     *
     * @param string $path          The path to go.
     * @param string $method        The HTTP method to use.
     */
    public function iSendARequestTo(string $path, string $method)
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /**
     * @Then the status code should be :statusCode
     *
     * @param int $statusCode       The status code expected.
     *
     * @throws \LogicException      If the status code isn't right.
     */
    public function theStatusCodeShouldBe(int $statusCode)
    {
        if ($statusCode !== $this->response->getStatusCode()) {
            throw new \LogicException(
                sprintf(
                    'Bad status code ! Found %d',
                    $this->response->getStatusCode()
                )
            );
        }
    }
}

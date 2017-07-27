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
     * @param string $path
     * @param string $method
     *
     * @When I send a request to :path using :method method
     */
    public function iSendARequestToUsingMethod(string $path, string $method)
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /**
     * @param int $statusCode
     *
     * @throws \LogicException
     *
     * @Then the response status code should be :statusCode
     */
    public function theResponseStatusCodeShouldBe(int $statusCode)
    {
        if ($this->response->getStatusCode() !== $statusCode) {
            throw new \LogicException(
                sprintf(
                    'Bad status code received !'
                )
            );
        }
    }
}

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
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class ApiContext
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Response
     */
    private $response;

    /**
     * ApiContext constructor.
     *
     * @param KernelInterface   $kernel
     */
    public function __construct(KernelInterface $kernel) {
        $this->kernel = $kernel;
    }

    /**
     * @When i send a request to :path using :method method and with body:
     *
     * @param string        $path
     * @param string        $method
     * @param PyStringNode  $body
     *
     * @throws \Exception
     */
    public function iSendARequestToUsingMethodAndWithBody(
        string $path,
        string $method,
        PyStringNode $body
    ) {
        $this->response = $this->kernel->handle(
            Request::create($path, $method, json_decode($body->getRaw(), true))
        );
    }

    /**
     * @When i send a request to :path using :method method
     *
     * @param string $path      The path to go.
     * @param string $method    The HTTP method to use.
     */
    public function iSendARequestToUsingMethod(string $path, string $method)
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /**
     * @Then the response should have status code :statusCode and be typed :type
     *
     * @param int $statusCode    The status code expected.
     * @param string $type       The Content/Type of the response.
     *
     * @throws \LogicException   If the status code doesn't match.
     * @throws \LogicException   If the headers type doesn't match.
     */
    public function theResponseShouldHaveStatusCodeAndBeTyped(
        int $statusCode,
        string $type
    ) {
        if ($this->response->getStatusCode() !== $statusCode) {
            throw new \LogicException(
                sprintf(
                    'Bad status code ! Found %d',
                    $this->response->getStatusCode()
                )
            );
        }

        if ($this->response->headers->get('Content-Type') !== $type) {
            throw new \LogicException(
                sprintf(
                    'Bad typed headers ! Found %s',
                    $this->response->headers->get('Content-Type')
                )
            );
        }
    }

    /**
     * @Then the body must contain :
     *
     * @param PyStringNode $body
     *
     * @throws \LogicException
     */
    public function theBodyMustContain(PyStringNode $body)
    {
        if ($this->response->getContent() !== $body) {
            throw new \LogicException(
                sprintf(
                    'Bad body expected ! Found %s',
                    $this->response->getContent()
                )
            );
        }
    }
}

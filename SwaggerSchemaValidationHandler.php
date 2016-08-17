<?php

namespace Fitbug\BackOfficeApi\Features\Support\Guzzle;

use FR3D\SwaggerAssertions\PhpUnit\Psr7AssertsTrait;
use FR3D\SwaggerAssertions\SchemaManager;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class SwaggerSchemaValidationHandler
 *
 * @package Fitbug\BackOfficeApi\Features\Support\Guzzle
 */
class SwaggerSchemaValidationHandler
{
    use Psr7AssertsTrait;

    /**
     * @var SchemaManager
     */
    private $schemaManager;

    private $skip;
    /**
     * @var Psr7RequestPrinterInterface
     */
    private $psr7RequestPrinter;
    /**
     * @var Psr7ResponsePrinterInterface
     */
    private $psr7ResponsePrinter;

    /**
     * @var string
     */
    private $uri;

    /**
     * SwaggerSchemaValidationHandler constructor.
     *
     * @param string                       $uri
     * @param Psr7RequestPrinterInterface  $psr7RequestPrinter
     * @param Psr7ResponsePrinterInterface $psr7ResponsePrinter
     */
    public function __construct(
        $uri,
        Psr7RequestPrinterInterface $psr7RequestPrinter = null,
        Psr7ResponsePrinterInterface $psr7ResponsePrinter = null
    ) {
        $this->uri = $uri;

        if (!$psr7RequestPrinter) {
            $psr7RequestPrinter = new Psr7RequestPrinter();
        }
        $this->psr7RequestPrinter = $psr7RequestPrinter;


        if (!$psr7ResponsePrinter) {
            $psr7ResponsePrinter = new Psr7ResponsePrinter();
        }
        $this->psr7ResponsePrinter = $psr7ResponsePrinter;
    }

    /**
     * @param bool $skip
     */
    public function setSkip(bool $skip)
    {
        $this->skip = $skip;
    }

    /**
     * @param callable $handler
     *
     * @return callable
     */
    public function __invoke(callable $handler)
    {
        return function (
            RequestInterface $request,
            array $options
        ) use ($handler) {
            $promise = $handler($request, $options);

            return $promise->then(
                function (ResponseInterface $response) use ($request) {
                    if (!$this->skip) {
                        // This needs to be done every time as it modifies itself during the validation
                        // meaning the second request will fail.
                        $schemaManager = $this->schemaManager = SchemaManager::fromUri($this->uri);

                        try {
                            $this->assertResponseAndRequestMatch($response, $request, $schemaManager);
                        } catch (\Exception $e) {
                            $requestString  = $this->psr7RequestPrinter->toString($request);
                            $responseString = $this->psr7ResponsePrinter->toString($response);

                            throw new \Exception(
                                "{$e->getMessage()}\n\n$requestString\n\n\n$responseString\n", $e->getCode(), $e
                            );
                        }
                    }

                    return $response;
                }
            );
        };
    }
}

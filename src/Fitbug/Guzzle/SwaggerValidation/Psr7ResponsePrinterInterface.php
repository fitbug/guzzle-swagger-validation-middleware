<?php

namespace Fitbug\Guzzle\SwaggerValidation;

use Psr\Http\Message\ResponseInterface;

/**
 * Builds a string from a PSR7 Response.
 */
interface Psr7ResponsePrinterInterface
{
    /**
     * Generate a pretty PS7 response.
     *
     * @param ResponseInterface $response
     *
     * @return string
     */
    public function toString(ResponseInterface $response);
}

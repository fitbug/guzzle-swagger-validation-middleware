<?php

namespace Fitbug\Guzzle\SwaggerValidation;

use Psr\Http\Message\RequestInterface;

/**
 * Builds a string from a PSR7 Request.
 */
interface Psr7RequestPrinterInterface
{
    /**
     * Generate a pretty PS7 request.
     *
     * @param RequestInterface $request
     *
     * @return string
     */
    public function toString(RequestInterface $request);
}

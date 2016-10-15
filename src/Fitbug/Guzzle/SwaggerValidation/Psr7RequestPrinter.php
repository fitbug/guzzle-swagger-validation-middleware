<?php

namespace Fitbug\Guzzle\SwaggerValidation;

use Psr\Http\Message\RequestInterface;

/**
 * Builds a string from a PSR7 Request.
 */
class Psr7RequestPrinter extends AbstractPsr7MesssagePrinter implements Psr7RequestPrinterInterface
{
    /**
     * Generate a pretty PS7 request.
     *
     * @param RequestInterface $request
     *
     * @return string
     */
    public function toString(RequestInterface $request)
    {
        $string = sprintf(
            "%s %s HTTP/%s\n",
            $request->getMethod(),
            $request->getRequestTarget(),
            $request->getProtocolVersion()
        );

        $string .= $this->headersAndBody($request);

        return $string;
    }
}

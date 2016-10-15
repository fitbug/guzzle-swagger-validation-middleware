<?php

namespace Fitbug\Guzzle\SwaggerValidation;

use Psr\Http\Message\ResponseInterface;

/**
 * Builds a string from a PSR7 Response.
 */
class Psr7ResponsePrinter extends AbstractPsr7MesssagePrinter implements Psr7ResponsePrinterInterface
{
    /**
     * Generate a pretty PS7 response.
     *
     * @param ResponseInterface $response
     *
     * @return string
     */
    public function toString(ResponseInterface $response)
    {
        $string = sprintf(
            "HTTP/%s %s %s\n",
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

        $string .= $this->headersAndBody($response);

        return $string;
    }
}

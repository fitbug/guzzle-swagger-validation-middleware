<?php

namespace Fitbug\BackOfficeApi\Features\Support\Guzzle;

use Psr\Http\Message\ResponseInterface;

class Psr7ResponsePrinter extends Psr7MesssagePrinter implements Psr7ResponsePrinterInterface
{
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

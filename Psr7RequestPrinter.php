<?php


namespace Fitbug\BackOfficeApi\Features\Support\Guzzle;


use Psr\Http\Message\RequestInterface;

class Psr7RequestPrinter extends Psr7MesssagePrinter implements Psr7RequestPrinterInterface
{

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
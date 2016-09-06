<?php

namespace Fitbug\BackOfficeApi\Features\Support\Guzzle;

use Psr\Http\Message\RequestInterface;

interface Psr7RequestPrinterInterface
{
    public function toString(RequestInterface $request);
}

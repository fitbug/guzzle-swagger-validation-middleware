<?php
namespace Fitbug\BackOfficeApi\Features\Support\Guzzle;

use Psr\Http\Message\ResponseInterface;

interface Psr7ResponsePrinterInterface
{
    public function toString(ResponseInterface $response);
}
<?php

namespace spec\Fitbug\Guzzle\SwaggerValidation;

use Fitbug\Guzzle\SwaggerValidation\Psr7RequestPrinter;
use Fitbug\Guzzle\SwaggerValidation\Psr7RequestPrinterInterface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;

class Psr7RequestPrinterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Psr7RequestPrinter::class);
    }

    public function it_implements_an_interface()
    {
        $this->shouldImplement(Psr7RequestPrinterInterface::class);
    }

    public function it_can_print_a_psr7_request_prettyish(RequestInterface $request)
    {
        $request->getMethod()->willReturn('POST');
        $request->getRequestTarget()->willReturn('/an/example?to=test');
        $request->getProtocolVersion()->willReturn('1.1');
        $request->getHeaders()->willReturn(
            [
                'Host'         => ['example.com'],
                'Content-Type' => ['application/json'],
                'Accepts'      => ['application/xml', 'application/json'],
            ]
        );
        $request->getBody()->willReturn('{"this is my body": true}');

        $response = <<<'EXPECTED'
POST /an/example?to=test HTTP/1.1
Host: example.com
Content-Type: application/json
Accepts: application/xml
Accepts: application/json

{"this is my body": true}
EXPECTED;


        $this->toString($request)->shouldReturn($response);
    }
}

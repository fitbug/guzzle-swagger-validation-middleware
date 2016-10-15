<?php

namespace spec\Fitbug\Guzzle\SwaggerValidation;

use Fitbug\Guzzle\SwaggerValidation\Psr7ResponsePrinter;
use Fitbug\Guzzle\SwaggerValidation\Psr7ResponsePrinterInterface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;

class Psr7ResponsePrinterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Psr7ResponsePrinter::class);
    }

    public function it_implements_an_interface()
    {
        $this->shouldImplement(Psr7ResponsePrinterInterface::class);
    }

    public function it_is_able_to_print_a_pretty_string_version_of_a_http_response(ResponseInterface $response)
    {
        $response->getProtocolVersion()->willReturn('1.1');
        $response->getStatusCode()->willReturn(200);
        $response->getReasonPhrase()->willReturn('OK');
        $response->getHeaders()->willReturn(
            [
                'Date'             => ['Mon, 23 May 2005 22:38:34 GMT'],
                'Content-Type'     => ['text/html; charset=UTF-8'],
                'Content-Encoding' => ['UTF-8'],
                'Content-Length'   => [138],
                'Last-Modified'    => ['Wed, 08 Jan 2003 23:11:55 GMT'],
                'Server'           => ['Apache/1.3.3.7 (Unix) (Red-Hat/Linux)'],
                'ETag'             => ['"3f80f-1b6-3e1cb03b"'],
                'Accept-Ranges'    => ['bytes'],
                'Connection'       => ['close'],
            ]
        );

        $response->getBody()->willReturn(
            '<html>
<head>
  <title>An Example Page</title>
</head>
<body>
  Hello World, this is a very simple HTML document.
</body>
</html>'
        );

        $expected
            = <<<'EXPECTED'
HTTP/1.1 200 OK
Date: Mon, 23 May 2005 22:38:34 GMT
Content-Type: text/html; charset=UTF-8
Content-Encoding: UTF-8
Content-Length: 138
Last-Modified: Wed, 08 Jan 2003 23:11:55 GMT
Server: Apache/1.3.3.7 (Unix) (Red-Hat/Linux)
ETag: "3f80f-1b6-3e1cb03b"
Accept-Ranges: bytes
Connection: close

<html>
<head>
  <title>An Example Page</title>
</head>
<body>
  Hello World, this is a very simple HTML document.
</body>
</html>
EXPECTED;
        $this->toString($response)->shouldReturn($expected);
    }
}

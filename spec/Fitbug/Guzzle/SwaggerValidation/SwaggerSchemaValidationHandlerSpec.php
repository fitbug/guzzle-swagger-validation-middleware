<?php

namespace spec\Fitbug\Guzzle\SwaggerValidation;

use Fitbug\Guzzle\SwaggerValidation\SwaggerSchemaValidationHandler;
use PhpSpec\ObjectBehavior;

class SwaggerSchemaValidationHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beConstructedWith('file:///a/path/to/swagger.json');
        $this->shouldHaveType(SwaggerSchemaValidationHandler::class);
    }
}

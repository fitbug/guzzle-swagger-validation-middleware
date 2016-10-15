# Guzzle Middleware: Swagger Validation Middleware

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fitbug/guzzle-swagger-validation-middleware/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fitbug/guzzle-swagger-validation-middleware/?branch=master)
[![Build Status](https://travis-ci.org/fitbug/guzzle-swagger-validation-middleware.svg?branch=master)](https://travis-ci.org/fitbug/guzzle-swagger-validation-middleware)
[![StyleCI Status](https://styleci.io/repos/70977859/shield)](https://styleci.io/repos/70977859)

A guzzle middleware that can be used to validate if requests and 
responses match what is defined in the schema

## Getting Started

### Prerequisities

You'll need to install:

 * PHP (Minimum 5.6)

### Installing

```bash
composer require fitbug/guzzle-swagger-validation-middleware
```

## Usage

Simply add it to the guzzle you use as middleware.

```php
$this->messageFactory = new GuzzleMessageFactory();
$swaggerFile = 'file://';
$swaggerFile .= '/path/to/your/swagger.json';
$this->swaggerValidation = new SwaggerSchemaValidationHandler($swaggerFile);
$stack = new HandlerStack();
$stack->setHandler(GuzzleHttp\choose_handler());
$stack->push($this->swaggerValidation);
$this->httpClient = GuzzleClientFactory::createWithConfig(
    [
        'base_uri' => $apiEndpoint,
        'handler' => $stack,
    ]
);
```

You get output like the request or response doesn't match the specification

```
 PHPUnit_Framework_ExpectationFailedException: Failed asserting that 'application/json, application/json' is an allowed media type (application/json). in vendor/phpunit/phpunit/src/Framework/Constraint.php:115
      Stack trace:
      #0 vendor/phpunit/phpunit/src/Framework/Constraint.php(58): PHPUnit_Framework_Constraint->fail('application/jso...', '')
      #1 vendor/phpunit/phpunit/src/Framework/Assert.php(1980): PHPUnit_Framework_Constraint->evaluate('application/jso...', '')
      #2 vendor/fr3d/swagger-assertions/src/PhpUnit/AssertsTrait.php(128): PHPUnit_Framework_Assert::assertThat('application/jso...', Object(FR3D\SwaggerAssertions\PhpUnit\MediaTypeConstraint), '')
      #3 vendor/fr3d/swagger-assertions/src/PhpUnit/Psr7AssertsTrait.php(89): Fitbug\BackOfficeApi\Features\Support\Guzzle\SwaggerSchemaValidationHandler->assertRequestMediaTypeMatch('application/jso...', Object(FR3D\SwaggerAssertions\SchemaManager), '/v0/company', 'POST', '')
...snip...
      #45 vendor/symfony/symfony/src/Symfony/Component/Console/Command/Command.php(256): Behat\Testwork\Cli\Command->execute(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #46 vendor/symfony/symfony/src/Symfony/Component/Console/Application.php(818): Symfony\Component\Console\Command\Command->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #47 vendor/symfony/symfony/src/Symfony/Component/Console/Application.php(186): Symfony\Component\Console\Application->doRunCommand(Object(Behat\Testwork\Cli\Command), Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #48 vendor/behat/behat/src/Behat/Testwork/Cli/Application.php(121): Symfony\Component\Console\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #49 vendor/symfony/symfony/src/Symfony/Component/Console/Application.php(117): Behat\Testwork\Cli\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #50 vendor/behat/behat/bin/behat(32): Symfony\Component\Console\Application->run()
      #51 {main}
      
      Next Exception: Failed asserting that 'application/json, application/json' is an allowed media type (application/json).
      
      POST /v0/company HTTP/1.1
      User-Agent: GuzzleHttp/6.2.1 curl/7.35.0 PHP/7.0.7
      Host: localhost
      Accept: application/json
      Accept: application/json
      Content-Type: application/json
      Content-Type: application/json
      Authorization: FITBUG-INTERNAL client-id=behat
      
      {"name":"starhealth","description":"some description","contact_email":"some support information"}
      
      
      HTTP/1.1 500 Internal Server Error
      Date: Thu, 08 Sep 2016 10:47:15 GMT
      Server: Apache/2.4.10 (Debian)
      Vary: Authorization
      X-Powered-By: PHP/7.0.10
      Set-Cookie: PHPSESSID=93257eb031eb0a7b84e4a2af7fef1495; path=/; HttpOnly
      Cache-Control: no-cache
      Content-Length: 195
      Connection: close
      Content-Type: application/json
      
      {
          "meta": {
              "error": {
                  "number": 2004,
                  "message": "Unknown error",
                  "user_message": "An unknown error has occured"
              }
          },
          "data": {}
      }
       in features/support/Guzzle/SwaggerSchemaValidationHandler.php:99
      Stack trace:
      #0 vendor/guzzlehttp/promises/src/Promise.php(203): Fitbug\BackOfficeApi\Features\Support\Guzzle\SwaggerSchemaValidationHandler->Fitbug\BackOfficeApi\Features\Support\Guzzle\{closure}(Object(GuzzleHttp\Psr7\Response))
      #1 vendor/guzzlehttp/promises/src/Promise.php(169): GuzzleHttp\Promise\Promise::callHandler(1, Object(GuzzleHttp\Psr7\Response), Array)
      #2 vendor/guzzlehttp/promises/src/FulfilledPromise.php(39): GuzzleHttp\Promise\Promise::GuzzleHttp\Promise\{closure}(Object(GuzzleHttp\Psr7\Response))
      #3 vendor/guzzlehttp/promises/src/TaskQueue.php(61): GuzzleHttp\Promise\FulfilledPromise::GuzzleHttp\Promise\{closure}()
...snip...
      #41 vendor/symfony/symfony/src/Symfony/Component/Console/Application.php(186): Symfony\Component\Console\Application->doRunCommand(Object(Behat\Testwork\Cli\Command), Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #42 vendor/behat/behat/src/Behat/Testwork/Cli/Application.php(121): Symfony\Component\Console\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #43 vendor/symfony/symfony/src/Symfony/Component/Console/Application.php(117): Behat\Testwork\Cli\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #44 vendor/behat/behat/bin/behat(32): Symfony\Component\Console\Application->run()
      #45 {main}
      
      Next RuntimeException: Invalid exception returned from Guzzle6 in vendor/php-http/guzzle6-adapter/src/Promise.php:65
      Stack trace:
      #0 vendor/guzzlehttp/promises/src/Promise.php(203): Http\Adapter\Guzzle6\Promise->Http\Adapter\Guzzle6\{closure}(Object(Exception))
      #1 vendor/guzzlehttp/promises/src/Promise.php(156): GuzzleHttp\Promise\Promise::callHandler(2, Object(Exception), Array)
      #2 vendor/guzzlehttp/promises/src/TaskQueue.php(61): GuzzleHttp\Promise\Promise::GuzzleHttp\Promise\{closure}()
      #3 vendor/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php(96): GuzzleHttp\Promise\TaskQueue->run()
...snip...
      #41 vendor/behat/behat/src/Behat/Testwork/Cli/Application.php(121): Symfony\Component\Console\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #42 vendor/symfony/symfony/src/Symfony/Component/Console/Application.php(117): Behat\Testwork\Cli\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
      #43 vendor/behat/behat/bin/behat(32): Symfony\Component\Console\Application->run()
      #44 {main}
```

## Running the tests

First checkout the library, then run

```bash
composer install
```

### Coding Style

We follow PSR2, and also enforce PHPDocs on all functions. To run the tests for coding style violations

```bash
vendor/bin/phpcs -p --standard=psr2 src/
```

### Unit tests

We use PHPSpec for unit tests. To run the unit tests

```bash
vendor/bin/phpspec run
```

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code
of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions
available, see the [tags on this repository](https://github.com/fitbug/guzzle-swagger-validation-middleware/tags).

## Authors

See the list of [contributors](https://github.com/fitbug/guzzle-swagger-validation-middleware/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

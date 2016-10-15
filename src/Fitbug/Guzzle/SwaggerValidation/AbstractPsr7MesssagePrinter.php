<?php

namespace Fitbug\Guzzle\SwaggerValidation;

use Psr\Http\Message\MessageInterface;

/**
 * Print a request or response PSR7 Message.
 */
abstract class AbstractPsr7MesssagePrinter
{
    /**
     * Generate the headers and body part of the message.
     *
     * @param MessageInterface $message
     *
     * @return string
     */
    protected function headersAndBody(MessageInterface $message)
    {
        $string = '';

        foreach ($message->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                $string .= $name.': '.$value."\n";
            }
        }

        $string .= "\n";
        $string .= (string) $message->getBody();

        return $string;
    }
}

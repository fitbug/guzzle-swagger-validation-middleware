<?php


namespace Fitbug\BackOfficeApi\Features\Support\Guzzle;


use Psr\Http\Message\MessageInterface;

abstract class Psr7MesssagePrinter
{
    protected function headersAndBody(MessageInterface $message)
    {
        $string = "";

        foreach ($message->getHeaders() as $name => $values) {
            foreach($values as $value) {
                $string .= $name . ": " . $value . "\n";
            }
        }

        $string .= "\n";
        $string .= (string)$message->getBody();

        return $string;
    }
}
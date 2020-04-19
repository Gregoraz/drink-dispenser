<?php

namespace App\Logger;

use UnexpectedValueException;

class EchoLogger implements LoggerInterface
{

    public function log($message): void
    {
        try {
            if (gettype($message) === 'string') {
                $this->logFromString($message);
            } elseif (gettype($message) === 'array') {
                $this->logFromArray($message);
            } else {
                throw new UnexpectedValueException(__CLASS__ . ' ' . __METHOD__ . ' supports string and array as an argument. You have given: ' . gettype($message));
            }
        } catch (UnexpectedValueException $exception) {
            echo "$exception \n";
        }
    }

    private function logFromString(string $output)
    {
        echo $output . "\n";
    }

    private function logFromArray(array $output)
    {
        for($i = 0, $iMax = count($output); $i < $iMax; $i++) {
            echo $output[$i] . "\n";
        }
        echo "\n";
    }

}
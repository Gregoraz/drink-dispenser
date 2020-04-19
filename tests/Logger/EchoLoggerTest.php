<?php

namespace Tests\Logger;

use PHPUnit\Framework\TestCase;
use App\Logger\EchoLogger;
use App\Logger\LoggerInterface;

class EchoLoggerTest extends TestCase
{
    public function testHasLoggerInterface()
    {
        $echoLogger = new EchoLogger();
        $this->assertEquals(true, $echoLogger instanceof LoggerInterface);
    }

    public function testLoggerOutput()
    {
        $echoLogger = new EchoLogger();
        $echoLogger->log('Test');
        $this->expectOutputString("Test\n");
    }
}
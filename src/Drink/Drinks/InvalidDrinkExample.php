<?php declare(strict_types=1);

/*
 * Class example, that is not extending abstract class App\Drinks\DrinkAbstract, which is implementing DrinkInterface
*/

namespace App\Drink\Drinks;

use App\Logger\EchoLogger;

final class InvalidDrinkExample
{
    private $drinkName;
    private $capacity;
    private $content;
    private $autoRefills;
    private $logger;

    private $receipt;
    private $description;

    public function __construct(int $milliliters, int $autoRefills = 2)
    {
        $this->drinkName = 'Invalid drink example';
        $this->capacity = $milliliters;
        $this->content = 0;
        $this->autoRefills = $autoRefills;
        $this->logger = new EchoLogger();

        $this->receipt = [
            'Step 1',
            'Step 2',
            'Step 3',
            'Step 4'
        ];

        $this->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
         ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
         eu fugiat nulla pariatur.';
    }

    public function getDrinkName()
    {
        return $this->drinkName;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function dispense(int $milliliters): void
    {
        $this->content -= $milliliters;
    }

    public function refill(): void
    {
        $this->content = $this->capacity;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAutoRefills(): int
    {
        return $this->autoRefills;
    }

    public function setAutoRefills(int $autoRefills): void
    {
        $this->autoRefills = $autoRefills;
    }

    public function prepare()
    {
        $this->makeStep1();
        $this->makeStep2();
        $this->makeStep3();
        $this->makeStep4();
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getReceipt(): array
    {
        return $this->receipt;
    }

    private function makeStep1()
    {
        $this->logger->log('Making step 1...');
    }

    private function makeStep2()
    {
        $this->logger->log('Making step 2...');
    }

    private function makeStep3()
    {
        $this->logger->log('Making step 3...');
    }

    private function makeStep4()
    {
        $this->logger->log('Making step 4...');
    }
}
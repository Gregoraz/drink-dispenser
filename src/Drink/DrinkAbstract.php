<?php declare(strict_types=1);

namespace App\Drink;

use App\Logger\EchoLogger;

abstract class DrinkAbstract implements DrinkInterface
{
    abstract function prepare();
    abstract function getReceipt();
    abstract function getDescription();

    private $drinkName;
    private $capacity;
    private $content;
    private $autoRefills;
    private $logger;

    public function __construct(int $milliliters, int $autoRefills = 2)
    {
        $this->capacity = $milliliters;
        $this->content = 0;
        $this->autoRefills = $autoRefills;
        $this->drinkName = 'Unkown drink';
        $this->logger = new EchoLogger();
    }

    public function setDrinkName(string $drinkName): void
    {
        $this->drinkName = $drinkName;
    }

    public function getDrinkName(): string
    {
        return $this->drinkName;
    }

    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getCapacity(): int
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

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getContent(): int
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

    public function getLogger(): EchoLogger
    {
        return $this->logger;
    }
}
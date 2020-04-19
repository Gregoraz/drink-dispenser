<?php declare(strict_types=1);

namespace App\Drink;

use App\Logger\EchoLogger;

interface DrinkInterface
{
    public function prepare();
    public function getReceipt();
    public function getDescription();
    public function setDrinkName(string $drinkName): void;
    public function getDrinkName(): string;
    public function setCapacity(int $capacity): void;
    public function getCapacity(): int;
    public function refill(): void;
    public function setContent($content): void;
    public function getContent(): int;
    public function getAutoRefills(): int;
    public function setAutoRefills(int $autoRefills): void;
    public function getLogger(): EchoLogger;
}
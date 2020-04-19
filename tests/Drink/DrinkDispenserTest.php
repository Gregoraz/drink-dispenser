<?php declare(strict_types=1);

namespace Tests\Drink;

use PHPUnit\Framework\TestCase;
use App\Drink\DrinkDispenser;
use App\Drink\Drinks;

final class DrinkDispenserTest extends TestCase
{

    public function testDispense(): void
    {
        $drink = new Drinks\PineappleJuice(500);
        $drinkDispenser = new DrinkDispenser($drink);
        $drinkDispenser->refill();
        $contentBefore = $drink->getContent();
        $drinkDispenser->dispense(300);
        $contentAfter = $drink->getContent();

        $this->assertNotEquals($contentBefore, $contentAfter);
    }

    public function testInvalidDrinkHasNotBeenDispensed(): void
    {
        $invalidDrink = new Drinks\InvalidDrinkExample(5000);
        $drinkDispenser = new DrinkDispenser($invalidDrink);
        $drinkDispenser->refill();
        $contentBefore = $invalidDrink->getContent();
        $drinkDispenser->dispense(500);

        $this->assertEquals($contentBefore, $invalidDrink->getContent());
    }

    public function testNegativeMillilitersWillNotDispense(): void
    {
        $drink = new Drinks\PineappleJuice(500);
        $drinkDispenser = new DrinkDispenser($drink);
        $drinkDispenser->refill();
        $contentBefore = $drink->getContent();
        $drinkDispenser->dispense(-1);
        $contentAfter = $drink->getContent();

        $this->assertEquals($contentBefore, $contentAfter);
    }

    public function testNotEnoughContentWillNotDispense(): void
    {
        $drink = new Drinks\PineappleJuice(500);
        $drinkDispenser = new DrinkDispenser($drink);
        $drinkDispenser->refill();
        $drinkDispenser->dispense(300);
        $contentBefore = $drink->getContent();
        $drinkDispenser->dispense(300);
        $contentAfter = $drink->getContent();

        $this->assertEquals($contentBefore, $contentAfter);
    }

    public function testRefill(): void
    {
        $drink = new Drinks\PineappleJuice(5000);
        $drinkDispenser = new DrinkDispenser($drink);
        $contentBefore = $drink->getContent();
        $drinkDispenser->refill();
        $contentAfter = $drink->getContent();

        $this->assertNotEquals($contentBefore, $contentAfter);
    }
}
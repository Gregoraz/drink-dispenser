<?php declare(strict_types=1);


namespace Tests\Board;

use App\Drink\DrinkDispenser;
use App\Drink\Drinks\PineappleJuice;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    const DRINK_FOLDER = __DIR__ . '/../../src/Drink/Drinks';
    const INITIAL_CAPACITY = 5000;
    const TAP_VALUE = 4000;

    public function testRefillOne()
    {
        $drink = new PineappleJuice(self::INITIAL_CAPACITY);
        $refillsOnStart = $drink->getAutoRefills();
        $drinkDispenser = new DrinkDispenser($drink);
        while ($drink->getAutoRefills() > 0) {
            $drinkDispenser->refill()->stir();
                if (method_exists($drink, 'getContent')) {
                    while ($drink->getContent() >= self::TAP_VALUE) {
                        $drinkDispenser->dispense(self::TAP_VALUE);
                    }
                    $drinkDispenser->dispense($drink->getContent());
                    $drink->setAutoRefills($drink->getAutoRefills() - 1);
                }
        }
        $this->assertEquals(true, $drink->getAutoRefills() === 0);
        $this->assertNotEquals($refillsOnStart, $drink->getAutoRefills());
    }

    public function testDrinkClassesCanBeFound()
    {
        $this->assertEquals(true, is_dir(self::DRINK_FOLDER));
        $scannedDir = array_diff(scandir(self::DRINK_FOLDER), array('..', '.'));
        $this->assertEquals(true, count($scannedDir) > 0);
    }
}
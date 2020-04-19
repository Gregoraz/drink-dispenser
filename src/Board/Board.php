<?php declare(strict_types=1);

namespace App\Board;

use App\Drink\Drinks;
use App\Drink\DrinkDispenser;
use App\Exception\DrinkIsInvalidException;

class Board
{
    const DRINK_FOLDER = __DIR__ . '/../Drink/Drinks';
    const INITIAL_CAPACITY = 5000;
    const TAP_VALUE = 50;
    const RUN_AUTOMATE_REFILLING = true;
    const RUN_CUSTOM_REFILLING = true;

    public function main()
    {
        if (self::RUN_CUSTOM_REFILLING) {
            try {
                $this->customRefilling();
            } catch (\Exception $e) {
                echo 'Custom refilling fails! ' . $e->getMessage() . ' in ' . __CLASS__ . ' ' . __METHOD__ . "\n";
            }
        }
        if (self::RUN_AUTOMATE_REFILLING) {
            try {
                $this->automateRefilling();
            } catch (\Exception $e) {
                echo 'Automate refilling fails! ' . $e->getMessage() . ' in ' . __CLASS__ . ' ' . __METHOD__ . "\n";
            }
        }
    }

    private function customRefilling()
    {
        $pineappleJuice = new Drinks\PineappleJuice(5000);
        $drinkDispenser = new DrinkDispenser($pineappleJuice);
        $drinkDispenser->refill()->dispense(300)->dispense(300);

        //should throw exception: DrinkIsInvalidException
        $invalidDrinkExample = new Drinks\InvalidDrinkExample(400);
        $drinkDispenser = new DrinkDispenser($invalidDrinkExample);
        $drinkDispenser->refill()->dispense(300);

        //should throw exception: NotEnoughContentException
        $drinkDispenser = new DrinkDispenser($pineappleJuice);
        $drinkDispenser->refill()->dispense(10)->dispense(5000);

        //should throw exception: InvalidArgumentException, but should dispense 5000 as well
        $drinkDispenser = new DrinkDispenser($pineappleJuice);
        $drinkDispenser->refill()->dispense(-1)->dispense(5000);

        //should print out content of every method inside of PineappleJuice
        $drinkDispenser = new DrinkDispenser($pineappleJuice);
        $drinkDispenser->simulatePreparing();

        //should display drink description
        $drinkDispenser = new DrinkDispenser($pineappleJuice);
        $drinkDispenser->logDescription();

        //should display drink receipt
        $drinkDispenser = new DrinkDispenser($pineappleJuice);
        $drinkDispenser->logReceipt();
    }

    private function automateRefilling()
    {
        if (is_dir(self::DRINK_FOLDER)) {
            $scannedDir = array_diff(scandir(self::DRINK_FOLDER), array('..', '.'));
            foreach ($scannedDir as $drink) {
                if (is_file(self::DRINK_FOLDER . '/' . $drink)) {
                    $drinkName = explode('.', $drink)[0];
                    $namespace = 'App\Drink\Drinks\\' . $drinkName;
                    if (class_exists($namespace)) {
                        try {
                            $this->refillDrink(new $namespace(self::INITIAL_CAPACITY));
                        } catch (\Exception $exception) {
                            echo $exception . "\n";
                        }
                    } else {
                        throw new \Exception('Class ' . $namespace . ' does not exists! Called in: ' . __CLASS__ . ' ' . __METHOD__);
                    }
                } else {
                    throw new \Exception('File ' . self::DRINK_FOLDER . '/' . $drink . ' does not exists!');
                }
            }
        } else {
            throw new \Exception('Drinks folder could not be found in ' . __CLASS__ . ' ' . __METHOD__);
        }
    }

    private function refillDrink(object $drink)
    {
        $drinkDispenser = new DrinkDispenser($drink);
        try {
            if (!is_subclass_of($drink, 'App\Drink\DrinkAbstract')) {
                throw new DrinkIsInvalidException('Your object: ' . get_class($drink) . ' is not a valid drink object');
            }
        } catch (DrinkIsInvalidException $exception) {
            echo $exception . "\n";
            return;
        }

        while ($drink->getAutoRefills() > 0) {
            $drinkDispenser->refill()->stir();
            try {
                if (method_exists($drink, 'getContent')) {
                    while ($drink->getContent() >= self::TAP_VALUE) {
                        $drinkDispenser->dispense(self::TAP_VALUE);
                    }
                    if($drink->getContent() > 0) {
                        $drinkDispenser->dispense($drink->getContent());
                    }
                    $drink->setAutoRefills($drink->getAutoRefills() - 1);
                } else {
                    throw new \Exception('Method getContent does not exists in ' . get_class($drink) . ' object!');
                }
            } catch (\Exception $exception) {
                echo $exception . "\n";
            }
        }
    }
}
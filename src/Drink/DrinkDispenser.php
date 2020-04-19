<?php declare(strict_types=1);

namespace App\Drink;

use App\Board\Board;
use App\Logger\EchoLogger;
use App\Exception\NotEnoughContentException;
use App\Exception\DrinkIsInvalidException;
use App\Exception\InvalidArgumentException;

class DrinkDispenser
{
    private $drinkObject;
    private $board;
    private $logger;

    /*
     * we could set type App\DrinkAbstract\DrinkAbstract instead of type object, then we could be sure, that object is extending from abstract:
     * App\DrinkAbstract\DrinkAbstract but then we could not use other methods and requirements says it has to be validated in
     * dispense method
    */
    public function __construct(object $drink)
    {
        $this->drinkObject = $drink;
        $this->board = new Board();
        $this->logger = new EchoLogger();
    }

    public function dispense(int $milliliters): self
    {
        try {
            if($milliliters < 0) {
                throw new InvalidArgumentException('Argument for ' . __METHOD__ . ' has to be positive');
            }
        } catch(InvalidArgumentException $exception) {
            echo $exception->__toString();
            return $this;
        }
        try {
            if (!$this->isValid()) {
                throw new DrinkIsInvalidException('Your object: ' . get_class($this->drinkObject) . ' is not a valid drink object');
            } else {
                try {
                    $actualContent = $this->drinkObject->getContent();
                    if ($actualContent >= $milliliters) {
                        $this->drinkObject->dispense($milliliters);
                        $this->logger->log('Dispensing ' . $milliliters . ' from ' . get_class($this->drinkObject) . ' finished successfully.');
                    } else {
                        throw new NotEnoughContentException("Not enough content on that drink!\n You want to drink: $milliliters, but there is $actualContent available only!");
                    }
                } catch (NotEnoughContentException $exception) {
                    $this->logger->log($exception->__toString());
                }
            }
        } catch (DrinkIsInvalidException $exception) {
            $this->logger->log($exception->__toString());
        }

        return $this;
    }

    public function refill(): self
    {
        if (method_exists($this->drinkObject, 'dispense')) {
            $this->drinkObject->refill();
        }
        return $this;
    }

    public function empty(): self
    {
        $this->logger->log('Content of ' . $this->drinkObject->getDrinkName() . ' has been thrown out');
        $this->drinkObject->setContent(0);
        return $this;
    }

    public function stir(): self
    {
        $this->logger->log($this->drinkObject->getDrinkName() . ' has been stirred.');
        return $this;
    }

    public function logReceipt(): self
    {
        $this->logger->log($this->drinkObject->getReceipt());
        return $this;
    }

    public function logDescription(): self
    {
        $this->logger->log($this->drinkObject->getDescription());
        return $this;
    }

    public function simulatePreparing(): self
    {
        $this->drinkObject->prepare();
        return $this;
    }

    private function isValid(): bool
    {
        if (is_subclass_of($this->drinkObject, 'App\Drink\DrinkAbstract')) {
            return true;
        }
        return false;
    }
}
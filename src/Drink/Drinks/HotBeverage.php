<?php declare(strict_types=1);

namespace App\Drink\Drinks;

use App\Drink\DrinkAbstract;

class HotBeverage extends DrinkAbstract
{
    private $receipt;
    private $description;

    public function __construct(int $milliliters, int $autoRefills = 2)
    {
        parent::__construct($milliliters, $autoRefills);
        parent::setDrinkName('Hot Beverage');

        $this->receipt = [
            'Boil drink',
            'Fill the cup with boiling drink',
            'Melt'
        ];

        $this->description = 'Refers to a variety of alcoholic beverages. Modern versions are often made with hot or
         boiling water, and sometimes include lemon juice, lime juice, cinnamon or sugar to improve the taste. ... Mixed
         drink made of liquor and water with sugar and spices and served hot.';
    }

    public function prepare()
    {
        $this->boilDrink();
        $this->fillCup();
        $this->melt();
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

    public function getDescription()
    {
        return $this->description;
    }

    private function boilDrink()
    {
        parent::getLogger()->log('Boiling drink...');
    }

    private function fillCup()
    {
        parent::getLogger()->log('Filling cup with drink...');
    }

    private function melt()
    {
        parent::getLogger()->log('Melting hot beverage...');
    }

}
<?php declare(strict_types=1);

namespace App\Drink\Drinks;

use App\Drink\DrinkAbstract;

class Coffee extends DrinkAbstract
{
    private $receipt;
    private $description;

    public function __construct(int $milliliters, int $autoRefills = 2)
    {
        parent::__construct($milliliters, $autoRefills);
        parent::setDrinkName('Coffee');

        $this->receipt = [
            'Boil water',
            'Put coffee',
            'Fill the cup with boiling water',
            'Melt'
        ];

        $this->description = 'Coffee is a brewed drink prepared from roasted coffee beans, the seeds of berries from 
        certain Coffea species. Once ripe, coffee berries are picked, processed, and dried. ... Roasted beans are ground
        and then brewed with near-boiling water to produce the beverage known as coffee';
    }

    public function prepare()
    {
        $this->boilWater();
        $this->putWater();
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

    private function boilWater()
    {
        parent::getLogger()->log('Boiling water...');
    }

    private function putWater()
    {
        parent::getLogger()->log('Put coffee to cup...');
    }

    private function fillCup()
    {
        parent::getLogger()->log('Filling the cup with water...');
    }

    private function melt()
    {
        parent::getLogger()->log('Melting...');
    }

}
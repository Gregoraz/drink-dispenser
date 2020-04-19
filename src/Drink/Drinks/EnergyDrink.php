<?php declare(strict_types=1);

namespace App\Drink\Drinks;

use App\Drink\DrinkAbstract;

class EnergyDrink extends DrinkAbstract
{
    private $receipt;
    private $description;

    public function __construct(int $milliliters, int $autoRefills = 2)
    {
        parent::__construct($milliliters, $autoRefills);
        parent::setDrinkName('Energy Drink');

        $this->receipt = [
            'Open can',
            'Take glass',
            'Fill glass with energy drink',
            'Drink'
        ];

        $this->description = 'Energy drink, any beverage that contains high levels of a stimulant ingredient, usually 
        caffeine, as well as sugar and often supplements, such as vitamins or carnitine, and that is promoted as 
        a product capable of enhancing mental alertness and physical performance.';
    }

    public function prepare()
    {
        $this->openCan();
        $this->takeGlass();
        $this->fillGlass();
        $this->drink();
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

    public function getDescription()
    {
        return $this->description;
    }

    private function openCan()
    {
        parent::getLogger()->log('Opening energy drink can...');
    }

    private function takeGlass()
    {
        parent::getLogger()->log('Taking glass...');
    }

    private function fillGlass()
    {
        parent::getLogger()->log('Filling the glass with energy drink...');
    }

    private function drink()
    {
        parent::getLogger()->log('Drinking... Power +50!');
    }
}
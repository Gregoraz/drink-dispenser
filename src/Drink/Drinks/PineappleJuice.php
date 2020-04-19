<?php declare(strict_types=1);

namespace App\Drink\Drinks;

use App\Drink\DrinkAbstract;

final class PineappleJuice extends DrinkAbstract
{
    private $receipt;
    private $description;

    public function __construct(int $milliliters)
    {
        parent::__construct($milliliters);
        parent::setDrinkName('Pineapple Juice');

        $this->receipt = [
            'Wash pineapple',
            'Get sharp knife',
            'Cut pineapple on squares',
            'Put to juicer'
        ];

        $this->description = 'Pineapple juice is a liquid made from 
        pressing the natural liquid from the pulp of the pineapple 
        tropical plant. ... In manufacturing, pineapple juice is 
        typically canned. It is used as a single or mixed juice beverage, 
        and for smoothies, cocktails, culinary flavor, and as a meat tenderizer.';
    }

    public function prepare()
    {
       $this->washPineapple();
       $this->getSharpKnife();
       $this->cutPineapple();
       $this->putToJuicer();
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

    public function getDescription()
    {
        return $this->description;
    }

    private function washPineapple()
    {
        parent::getLogger()->log('Washing pineapple...');
    }

    private function getSharpKnife()
    {
        parent::getLogger()->log('Getting sharp knife...');
    }

    private function cutPineapple()
    {
        parent::getLogger()->log('Cutting pineapple on squares...');
    }

    private function putToJuicer()
    {
        parent::getLogger()->log('Put pineapple to juicer...');
    }
}
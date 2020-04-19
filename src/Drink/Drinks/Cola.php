<?php declare(strict_types=1);

namespace App\Drink\Drinks;

use App\Drink\DrinkAbstract;

class Cola extends DrinkAbstract
{
    private $receipt;
    private $description;

    public function __construct(int $milliliters, int $autoRefills = 2)
    {
        parent::__construct($milliliters, $autoRefills);
        parent::setDrinkName('Cola');

        $this->receipt = [
            'Open can',
            'Take glass',
            'Fill glass with cola',
            'Drink'
        ];

        $this->description = 'Cola is a sweetened, carbonated soft drink flavored with vanilla, cinnamon, citrus oils
         and other flavorings. Most contain caffeine, which was originally sourced from the kola nut, leading to the 
         drink\'s name, though other sources are now also used.';
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
        parent::getLogger()->log('Opening coke can...');
    }

    private function takeGlass()
    {
        parent::getLogger()->log('Taking glass...');
    }

    private function fillGlass()
    {
        parent::getLogger()->log('Filling the glass with delicious cola...');
    }

    private function drink()
    {
        parent::getLogger()->log('Drinking...');
    }

}
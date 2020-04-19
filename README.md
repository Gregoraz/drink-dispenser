# Drink Dispenser

## Bedarf
<ul>
    <li>Installierter Composer (benötigt für PHP Unit)</li>
    <li>PHP 7.2+ (CLI)</li>
</ul>

## Initialisierung
Führen Sie im Projektstammverzeichnis Folgendes aus:
```
composer install
php index.php
```

Das Skript führt den Code aus, der sich darin befindet:
```
src/Board/Board.php::main()
```
Hier können wir Variablen für die automatische Abgabe einstellen, wie die Kapazität des Getränks oder den Wert für einen
einzelnen Hahn in Millilitern.

Alle Status der durchgeführten Aktion sollten an die Konsole ausgegeben werden.

Bei dieser Methode werden zwei andere Methoden aufgerufen:
<ul>
    <li>customRefilling()</li>
    <li>automateRefilling()</li>
</ul>

<b>customRefilling</b> füllt und verzichtet die Getränke mit den kritischen Werten, wie z. B. dispense(-1) oder ungültiger Getränkeabgabe, und testet die Funktionalität im Allgemeinen.

<b>automateRefilling</b> füllt automatisch alle verfügbaren Getränke und gibt sie aus. Es scannt den Ordner:
```
src/Drink/Drinks
```
sucht nach den Klassen und erstellt automatisch Objekte daraus. Danach füllt es sie und gibt sie aus (wenn das Getränk richtig ist)

Um Anfangswerte zu ändern, müssen wir diese Konstanten bearbeiten:
```
const INITIAL_CAPACITY = 5000;
const TAP_VALUE = 50; 
const RUN_AUTOMATE_REFILLING = true;
const RUN_CUSTOM_REFILLING = true;
```

Der Code füllt das Getränk zweimal auf und gibt es aus.


## Tests
Führen Sie diesen Befehl im Stammverzeichnis aus, um Tests auszuführen:
```
./vendor/bin/phpunit tests
```

## Checkliste
[x] DrinkDispenser-Klasse
```
src/Drink/DrinkDispenser.php (App\Drink\DrinkDispenser)
```
[x] Mehrere Getränke-Klassen
```
src/Drink/Drinks/Coffee.php                     (App\Drink\Drinks\Coffee)
src/Drink/Drinks/Cola.php                       (App\Drink\Drinks\Cola)
src/Drink/Drinks/EnergyDrink.php                (App\Drink\Drinks\EnergyDrink)
src/Drink/Drinks/HotBeverage.php                (App\Drink\Drinks\HotBeverage)
src/Drink/Drinks/InvalidDrinkExample.php        (App\Drink\Drinks\InvalidDrinkExample)
src/Drink/Drinks/PineappleJuice.php             (App\Drink\Drinks\PineappleJuice)
```
[x] NotEnoughContentException
```
src/Exception/NotEnoughContentException.php     (App\Exception\NotEnoughContentException)
```

[x] Interfaces und/oder (abstrakte) Oberklassen nach Bedarf
```
src/Drink/DrinkInterface.php                    (App\Drink\DrinkInterface)
src/Drink/DrinkAbstract.php                     (App\Drink\DrinkAbstract)
```

[x] Programmablauf (initialisieren, befüllen, zapfen)
Zu initialisieren und benutzen drinkDispenser, wir müssen das Drink-Objekt an den Konstruktor übergeben:
```
$pineappleJuice = new PineAppleJuice(500)
$drinkDispanser = new DrinkDispanser($pineappleJuice);
$drinkDispenser->refill()->dispense(300);
```
Andere Möglichkeiten
```
$drinkDispenser->empty(); //macht den Behälter leer
$drinkDispenser->simulatePreparing(); //geht jede spezielle Methode in bestimmten Getränken durch und druckt Schritte
$drinkDispenser->logReceipt(); //druckt Getränkequittung
$drinkDispenser->logDescription(); //druckt Getränkebeschreibung
```
Beachten Sie, dass diese Abgabemethode nur mit einem gültigen Getränkeobjekt funktioniert.

## Antworten
```
$drinkMaster->refill($newDrink)->dispense(300);
```
Wie kann realisiert werden, dass (wie oben) mehrere Methodenaufrufe hintereinandergehängt werden können?

Im refill, wir müssen zurückkehren:
 ```
return $this
 ```
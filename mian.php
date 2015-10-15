<?php
require 'vendor/autoload.php';

use Engine\Game;
use Engine\Player;
use Engine\Resource;
use Engine\Dice;
use Engine\EventManager;

$evm = new EventManager();

$game = new Game();

$game->addPlayers(array(
    new Player('Humam', 12, 1,2, new Resource('Espada longa', 1,2, new Dice(6))),
    new Player('Orc', 20, 2,0, new Resource('Clava de madeira', 1, 0, new Dice(8))),
));

$game->run(new Dice(20));
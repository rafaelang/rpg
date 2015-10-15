<?php
require 'vendor/autoload.php';

use Engine\Game;
use Engine\Player;

$game = new Game();

$game->addPlayers(array(
    new Player('Humam', 12, 1,2),
    new Player('Orc', 20, 2,0),
));
<?php
require 'vendor/autoload.php';

use Engine\Game;
use Engine\Player;
use Engine\Resource;
use Engine\Dice;
use Engine\EventManager;

$evm = new EventManager();

$evm->on('game.run', '\Engine\Game::info');
$evm->on('game.addplayer', '\Engine\Game::info');
$evm->on('game.start', '\Engine\Game::info');
$evm->on('game.turn', '\Engine\Game::info');
$evm->on('game.end', '\Engine\Game::info');
$evm->on('player.start', '\Engine\Game::info');
$evm->on('player.attack', '\Engine\Game::info');
$evm->on('player.defense', '\Engine\Game::info');
$evm->on('player.damage', '\Engine\Game::info');

$game = new Game($evm);

$game->addPlayers(array(
    new Player('Humam', 12, 1,2, new Resource('Espada longa', 1,2, new Dice(6)), $game),
    new Player('Orc', 20, 2,0, new Resource('Clava de madeira', 1, 0, new Dice(8)), $game),
#    new Player('Time Lord', 20, 1,2, new Resource('TARDIS', 1, 1, new Dice(10)), $game),
#    new Player('SuperMan', 20, 2,3, new Resource('punhos', 2, 3, new Dice(10)), $game),
));

$game->run(new Dice(20));
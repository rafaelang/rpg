<?php
namespace Engine;

class Game implements IGame {
    private $players = [];

    public function addPlayers(array $players){
        foreach($players as $player)
        {
            $this->addPlayer($player);
        }
    }

    public function addPlayer(IPlayer $player){
        $this->players[] = $player;
    }
}
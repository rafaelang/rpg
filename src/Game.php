<?php
namespace Engine;

class Game implements IGame {
    public function addPlayers(array $players){
        foreach($players as $player)
        {
            $this->addPlayer($player);
        }
    }

    public function addPlayer(IPlayer $player){

    }
}
<?php
namespace Engine;

class Game implements IGame {
    private $players = [];
    private $dice = null;

    public function addPlayers(array $players){
        foreach($players as $player)
        {
            $this->addPlayer($player);
        }
    }

    public function addPlayer(IPlayer $player){
        $this->players[] = $player;
    }

    public function run(IDice $dice){
        $this->dice = $dice;

        $this->start();
    }

    public function start(){
        $dice = $this->dice;

        usort($this->players, function($player2, $player1) use ($dice){
            $p1 = $player1->start($dice);
            $p2 = $player2->start($dice);

            return $p1 < $p2 ? -1 : 1;
        });
    }
}
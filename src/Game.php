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

        do
        {
            $currentPlayer = $this->turn();
            $currentPlayer->attack($this->dice);

        } while (count(array_filter($this->players, function($player){ return $player->life > 0;})) > 1);
    }

    public function start(){
        $dice = $this->dice;

        usort($this->players, function($player2, $player1) use ($dice){
            do {
                $p1 = $player1->start($dice);
                $p2 = $player2->start($dice);
            } while ($p1 == $p2);

            return $p1 < $p2 ? -1 : 1;
        });
    }
}
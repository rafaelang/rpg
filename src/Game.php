<?php
namespace Engine;

class Game implements IGame {
    private $players = [];
    private $dice = null;
    private $turns = 0;
    private $evm = null;

    public function __construct(IEventManager $evm){
        $this->evm = $evm;

        $this->evm->on('game.run', array($this, 'info'));
        $this->evm->on('game.addplayer', array($this, 'info'));
        $this->evm->on('game.start', array($this, 'info'));
        $this->evm->on('game.round', array($this, 'info'));
        $this->evm->on('game.end', array($this, 'info'));
    }

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

        $this->evm->trigger('game.run', 'O jogo começou!');

        $this->start();

        do
        {
            list($currentPlayer, $opponet) = $this->turn();
            $currentPlayer->attack($this->dice, $opponet);

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

    public function turn(){
        $count_players = count($this->players);
        return array($this->players[$this->turns++ % $count_players], $this->players[$this->turns % $count_players]);
    }

    public static function info($data){
        echo $data."\n";
    }
}
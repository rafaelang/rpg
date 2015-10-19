<?php
namespace Engine;

class Game implements IGame {
    private $players = array();
    private $dice = null;
    private $turns = 0;
    public $evm = null;

    public function __construct(IEventManager $evm){
        $this->evm = $evm;
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
        if (count($this->players) < 2)
        {
            throw new \Exception('São necessários 2 players');
        }

        $this->dice = $dice;

        $this->evm->trigger('game.run', 'O jogo começou!');

        $this->start();

        do
        {
            list($currentPlayer, $opponet) = $this->turn();
            $currentPlayer->attack($this->dice, $opponet);

            $this->evm->trigger('game.turn', "{$currentPlayer} atacou {$opponet}");

            $this->players = array_values(array_filter($this->players, function($player){ return $player->life > 0;}));

        } while (count($this->players) > 1);

        $this->evm->trigger('game.end', "{$currentPlayer} é o vencedor!");
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

        $this->evm->trigger('game.start', "{$this->players[0]} vai começar!");
    }

    public function turn(){
        $count_players = count($this->players);
        $this->evm->trigger('game.turn', "------------------------ TURNO {$this->turns} ------------------------------");
        return array($this->players[$this->turns++ % $count_players], $this->players[$this->turns % $count_players]);
    }

    public static function info($data){
        echo $data."\n";
    }
}
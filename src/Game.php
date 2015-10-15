<?php
namespace Engine;

class Game implements IGame {
    private $players = [];
    private $dice = null;
    private $turns = 0;
    public $evm = null;

    public function __construct(IEventManager $evm){
        $this->evm = $evm;

        $this->evm->on('game.run', array($this, 'info'));
        $this->evm->on('game.addplayer', array($this, 'info'));
        $this->evm->on('game.start', array($this, 'info'));
        $this->evm->on('game.turn', array($this, 'info'));
        $this->evm->on('game.end', array($this, 'info'));
        $this->evm->on('player.attack', '\Engine\Game::info');
        $this->evm->on('player.defense', '\Engine\Game::info');
        $this->evm->on('player.damage', '\Engine\Game::info');
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

            $this->evm->trigger('game.turn', "{$currentPlayer} atacou {$opponet}");

        } while (count(array_filter($this->players, function($player){ return $player->life > 0;})) > 1);

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
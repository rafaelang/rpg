<?php
namespace Engine;

class Player implements IPlayer {
    public $name = '';
    public $life = 0;
    public $strong = 0;
    public $speed = 0;
    public $resource = null;
    private $evm = null;

    public function __construct($name, $life, $strong, $speed,IResource $resource, IGame $game){
        $this->name = $name;
        $this->life = $life;
        $this->strong = $strong;
        $this->speed = $speed;
        $this->resource = $resource;
        $this->evm = $game->evm;

        $this->evm->on('player.attack', '\Engine\Game::info');
        $this->evm->on('player.defense', '\Engine\Game::info');
        $this->evm->on('player.damage', '\Engine\Game::info');
    }

    public function start(IDice $dice){
        return $dice->rand() + $this->speed;
    }

    public function attack(IDice $dice, IPlayer $opponent){
        if($this->_attack($dice) > $opponent->defense($dice))
        {
            $this->damage($opponent);
        }
    }

    private function _attack(IDice $dice){
        $power = $dice->rand() + $this->speed + $this->resource->attack;
        $this->evm->trigger('player.attack', "$this atacou com força $power");
        return $power;
    }

    public function defense(IDice $dice){
        return $dice->rand() + $this->speed + $this->resource->defense;
    }

    public function damage(IPlayer $opponent){
        $power = $this->resource->dice->rand() + $this->strong;
        $opponent->life -= $power;
        $this->evm->trigger('player.damage', "$opponent sofreu dando de força $power");
    }

    public function __toString(){
        return "{$this->name} ({$this->life})";
    }
}
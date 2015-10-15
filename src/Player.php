<?php
namespace Engine;

class Player implements IPlayer {
    public $name = '';
    public $life = 0;
    public $strong = 0;
    public $speed = 0;
    public $resource = null;
    public $evm = null;

    public function __construct($name, $life, $strong, $speed,IResource $resource, IGame $game){
        if(!is_int($life) || !is_int($strong) || !is_int($speed))
        {
            throw new \Exception('life/strong/speed devem ser inteiros');
        }
        $this->name = $name;
        $this->life = $life;
        $this->strong = $strong;
        $this->speed = $speed;
        $this->resource = $resource;
        $this->evm = $game->evm;
    }

    public function start(IDice $dice){
        $power = $dice->rand() + $this->speed;
        $this->evm->trigger('player.attack', "$this iniciou com força $power");
        return $power;
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
        $power = $dice->rand() + $this->speed + $this->resource->defense;
        $this->evm->trigger('player.defense', "$this defendeu com força $power");
        return $power;
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
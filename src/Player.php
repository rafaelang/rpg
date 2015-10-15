<?php
namespace Engine;

class Player implements IPlayer {
    public $name = '';
    public $life = 0;
    public $strong = 0;
    public $speed = 0;
    public $resource = null;

    public function __construct($name, $life, $strong, $speed,IResource $resource, IGame $game){
        $this->name = $name;
        $this->life = $life;
        $this->strong = $strong;
        $this->speed = $speed;
        $this->resource = $resource;
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
        return $dice->rand() + $this->speed + $this->resource->attack;
    }

    public function defense(IDice $dice){
        return $dice->rand() + $this->speed + $this->resource->defense;
    }

    public function damage(IPlayer $opponent){
        $opponent->life -= $this->resource->dice->rand() + $this->strong;
    }

    public function __toString(){
        return "{$this->name} ({$this->life})";
    }
}
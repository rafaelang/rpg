<?php
namespace Engine;

class Player implements IPlayer {
    public $name = '';
    public $life = 0;
    public $strong = 0;
    public $speed = 0;
    public $resource = null;

    public function __construct($name, $life, $strong, $speed,IResource $resource){
        $this->name = $name;
        $this->life = $life;
        $this->strong = $strong;
        $this->speed = $speed;
        $this->resource = $resource;
    }

    public function start(IDice $dice){
        return $dice->rand() + $this->speed;
    }

    public function attack(IDice $dice){
        return $dice->rand() + $this->speed + $this->resource->attack;
    }
}
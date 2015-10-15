<?php
namespace Engine;

class Player implements IPlayer {
    public $name = '';
    public $life = 0;
    public $strong = 0;
    public $speed = 0;

    public function __construct($name, $life, $strong, $speed){
        $this->name = $name;
        $this->life = $life;
        $this->strong = $strong;
        $this->speed = $speed;
    }

    public function start(IDice $dice){

    }
}
<?php
namespace Engine;

class Resource implements IResource {
    public $name = '';
    public $attack = 0;
    public $defense = 0;
    public $dice = null;

    public function __construct($name, $attack, $defense, IDice $dice){
        if(!is_int($attack) || !is_int($defense))
        {
            throw new \Exception('attack/defense deve ser inteiro');
        }
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->dice = $dice;
    }
}
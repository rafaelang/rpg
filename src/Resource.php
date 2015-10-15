<?php
namespace Engine;

class Resource implements IResource {
    public $name = '';
    public $attack = 0;
    public $defense = 0;
    public $dice = null;

    public function __construct($name, $attack, $defense, IDice $dice){
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->dice = $dice;
    }
}
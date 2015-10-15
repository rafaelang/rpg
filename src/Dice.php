<?php
namespace Engine;

class Dice implements IDice {
    private $faces = 0;

    public function __construct($faces){
        $this->faces = (int)$faces;

        if ($this->faces < 4)
        {
            throw new \Exception('Dices faces deve ser maior ou igual a 4');
        }

    }

    public function rand(){
        return mt_rand(1, $this->faces);
    }
}
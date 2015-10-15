<?php
namespace Engine;

class Dice implements IDice {
    private $faces = 0;

    public function __construct($faces){
        $this->faces = (int)$faces;
    }

    public function rand(){
        return mt_rand(1, $this->faces);
    }
}
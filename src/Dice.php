<?php
namespace Engine;

class Dice implements IDice {
    private $faces = 0;

    public function __construct($faces){
        $this->faces = (int)$faces;
    }
}
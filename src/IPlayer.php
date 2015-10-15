<?php
namespace Engine;

interface IPlayer {
    function start(IDice $dice);
    function attack(IDice $dice, IPlayer $opponent);
    function defense(IDice $dice);
    function damage(IPlayer $opponent);
}
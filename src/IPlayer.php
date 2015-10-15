<?php
namespace Engine;

interface IPlayer {
    function start(IDice $dice);
    function attack(IDice $dice);
}
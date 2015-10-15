<?php
namespace Engine;

interface IGame {
    function addPlayer(IPlayer $player);
    function addPlayers(array $players);
    function run(IDice $dice);
}
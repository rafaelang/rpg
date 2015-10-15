<?php
namespace Engine;

interface IGame {
    function addPlayer(IPlayer $player);
    function addPlayers(array $players);
}
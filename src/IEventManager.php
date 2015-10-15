<?php
namespace Engine;

interface IEventManager {
    function on($name, $callback);
    function trigger($name, $data);
}
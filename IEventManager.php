<?php
namespace Engine;

interface EventManager {
    function on($name, $callback);
    function trigger($name, $data);
}
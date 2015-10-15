<?php
namespace Engine;

class EventManager implements IEventManager {
    private $events = array();

    public function on($name, $callback){
        $this->events[$name][] = $callback;
    }

    public function trigger($name, $data){
        if(in_array($name, array_keys($this->events)))
        {
            foreach($this->events[$name] as $callback)
            {
                call_user_func($callback, $data);
            }
        }
    }
}
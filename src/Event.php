<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\Events\Events;
use Closure;

abstract class Event
{
    protected Closure $afterTrigger;

    public function __construct(array $data = [])
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function setAfterTrigger(Closure $afterTrigger)
    {
        $this->afterTrigger = $afterTrigger;
    }

    public function getAfterTrigger() : ?Closure
    {
        return $this->afterTrigger ?? null;
    }

    public static function trigger(array $params = []) : Event
    {
        $class = get_called_class();

        $event = new $class($params);
        
        Events::trigger($class, $event);

        $afterTrigger = $event->getAfterTrigger();

        if ($afterTrigger)
        {
            $afterTrigger->bindTo($event, null)();
        }

        return $event;
    }

    public static function on($callback)
    {
        $class = get_called_class();

        Events::on($class, $callback);
    }
}
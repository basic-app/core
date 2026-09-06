<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
if (!function_exists('get_short_class'))
{
    function get_short_class(object $object)
    {
        $segments = explode('\\', get_class($object));

        $class = end($segments);
    
        return $class;
    }
}
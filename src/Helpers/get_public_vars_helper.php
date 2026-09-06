<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
if (!function_exists('get_public_vars'))
{
    function get_public_vars(object $object)
    {
        $func = function($object) {
            return get_object_vars($object);
        };

        $return = $func->bindTo(null, null)($object);
   
		return $return;
    }
}
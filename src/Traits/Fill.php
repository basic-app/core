<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Traits;

trait Fill
{
    public function fill(array $params)
    {
        foreach($params as $key => $value)
        {
            $this->$key = $value;
        }

        return $this;
    }
}
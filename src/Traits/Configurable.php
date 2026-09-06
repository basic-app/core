<?php

namespace BasicApp\Core\Traits;

trait Configurable
{
    public function loadConfig()
    {
        $config = config($this->configClass);

        helper('get_public_properties');

        foreach(get_public_properties($config) as $key => $value)
        {
            $this->$key = $value;
        }
    }
}
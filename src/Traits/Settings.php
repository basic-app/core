<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Traits;

trait Settings
{
    public function loadSettings()
    {
        $class = $this->settings;

        helper('get_public_vars');

        $settingNames = [];

        foreach(get_public_vars($this) as $key => $value) 
        {
            $settingNames[] = $class . '.' . $key;
        }

        foreach(service('settings')->getMany($settingNames) as $key => $value) 
        {
            list($class, $var) = explode('.', $key);

            $this->$var = $value ?? $this->$var;
        }
    }

    public function saveSettings()
    {
        $class = $this->settings;
        
        helper('get_public_vars');

        $settings = [];

        foreach(get_public_vars($this) as $key => $value)
        {
            $settings[$class . '.' . $key] = $value;
        }

        service('settings')->setMany($settings);
    }
}
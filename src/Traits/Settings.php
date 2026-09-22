<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Traits;

trait Settings
{
    public function getSettingsClass() : string
    {
        helper(['get_short_class']);

        return get_short_class($this);
    }

    public function getSettings(?string $settingsClass = null, ?array $attributeNames = null) : array
    {
        if (!$settingsClass)
        {
            $settingsClass = $this->getSettingsClass();
        }

        if ($attributeNames === null)
        {
            helper('get_public_vars');

            $attributeNames = array_keys(get_public_vars($this));
        }

        $settingNames = [];

        foreach($attributeNames as $attribute) 
        {
            $settingNames[] = $settingsClass . '.' . $attribute;
        }

        $return = [];

        foreach(service('settings')->getMany($settingNames) as $key => $value) 
        {
            list($class, $var) = explode('.', $key);

            if ($value !== null)
            {
                $return[$var] = $value;
            }
        }

        return $return;
    }

    public function setSettings(?string $settingsClass = null, ?array $values = null)
    {
        if (!$settingsClass)
        {
            $settingsClass = $this->getSettingsClass();
        }

        if ($values === null)
        {
            helper('get_public_vars');

            $values = get_public_vars($this);
        }

        $settings = [];

        foreach($values as $key => $value)
        {
            $settings[$settingsClass . '.' . $key] = $value;
        }

        service('settings')->setMany($settings);
    }
}
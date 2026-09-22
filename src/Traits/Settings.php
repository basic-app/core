<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Traits;

trait Settings
{
    public function getSettings(?string $settingsClass = null, ?array $attributeNames = null) : array
    {
        if (!$settingsClass)
        {
            helper(['get_short_class']);

            $settingsClass = get_short_class($this);
        }

        if ($attributeNames === null)
        {
            if (method_exists($this, 'getPublicProperties'))
            {
                $values = $this->getPublicProperties();
            }
            else
            {
                helper('get_public_vars');

                $values = get_public_vars($this);
            }

            $attributeNames = array_keys($values);
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
            helper(['get_short_class']);

            $settingsClass = get_short_class($this);
        }

        if ($values === null)
        {
            if (method_exists($this, 'getPublicProperties'))
            {
                $values = $this->getPublicProperties();
            }
            else
            {
                helper('get_public_vars');

                $values = get_public_vars($this);
            }
        }

        $settings = [];

        foreach($values as $key => $value)
        {
            $settings[$settingsClass . '.' . $key] = $value;
        }

        service('settings')->setMany($settings);
    }
}
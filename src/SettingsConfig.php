<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\Config\BaseConfig;
use BasicApp\Core\Interfaces\SettingsInterface;
use BasicApp\Core\Interfaces\FormInterface;
use BasicApp\Core\Traits\Settings;
use BasicApp\Core\Traits\Form;
use CodeIgniter\Traits\PropertiesTrait;

abstract class SettingsConfig extends BaseConfig implements SettingsInterface, FormInterface 
{
    use Settings;
    use Form;
    use PropertiesTrait;

    public function __construct()
    {
        parent::__construct();

        if (static::$override)
        {
            static::$override = false;

            $this->fill($this->getSettings());

            static::$override = true;
        }
    }

    public function save(&$errors = null) : bool
    {
        $this->setSettings();

        return true;
    }
}
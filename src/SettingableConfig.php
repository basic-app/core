<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\Config\BaseConfig;
use BasicApp\Core\Interfaces\SettingsInterface;

abstract class SettingableConfig extends BaseConfig
{
    protected $settingsClass;

    protected SettingsInterface $settingsInstance;

    public function __construct()
    {
        $class = $this->settingsClass;

        $this->settingsInstance = new $class();

        helper(['get_object_vars']);

        foreach(get_object_vars($this->settingsInstance) as $key => $value)
        {
            $this->$key = $value;
        }

        parent::__construct();
    }
} 
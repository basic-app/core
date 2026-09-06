<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use BasicApp\Core\Traits\Settings as SettingsTrait;
use BasicApp\Core\Traits\Labels;
use BasicApp\Core\Interfaces\SettingsInterface;
use BasicApp\Core\Traits\Configurable;

abstract class Settings implements SettingsInterface
{
    use SettingsTrait, Labels, Configurable;

    protected $configClass;

    protected $settings;

    public function __construct()
    {
        if ($this->configClass)
        {
            $this->loadConfig($this->configClass);
        }

        helper(['get_short_class']);

        $this->settings ??= get_short_class($this);

        $this->loadSettings($this->settings);
    }

    public function rules() : array
    {
        return [];
    }

    public function fill(array $data = []) : void
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function save() : bool
    {
        $this->saveSettings($this->settings);

        return true;
    }
}
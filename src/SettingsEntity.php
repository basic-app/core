<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use BasicApp\Core\Traits\Labels;
use BasicApp\Core\Traits\Upload;
use BasicApp\Core\Traits\UnlinkChanged;
use BasicApp\Core\Interfaces\SettingsInterface;

abstract class SettingsEntity extends Entity implements SettingsInterface
{
    use Labels, Upload, UnlinkChanged;

    protected $settings;

    public function __construct(?array $data = null)
    {
        helper(['get_short_class']);

        $this->settings ??= get_short_class($this);

        $this->loadSettings();

        parent::__construct($data);

        $this->syncOriginal();
    }

    public function loadSettings()
    {
        $settingNames = [];

        foreach(array_keys($this->attributes) as $key) 
        {
            $settingNames[] = $this->settings . '.' . $key;
        }

        foreach(service('settings')->getMany($settingNames) as $key => $value) 
        {
            list($c, $var) = explode('.', $key);

            $data[$var] = $value;
        }

        $this->fill($data);

        $this->syncOriginal();
    }

    public function save() : bool
    {
        $this->saveSettings();

        return true;
    }

    public function saveSettings()
    {
        $settings = [];

        foreach($this->attributes as $key => $value)
        {
            $settings[$this->settings . '.' . $key] = $value;
        }

        service('settings')->setMany($settings);
    }

    public function rules() : array
    {
        return [];
    }
} 
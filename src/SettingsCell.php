<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\View\Cells\Cell as BaseCell;
use BasicApp\Core\Traits\Settings;
use BasicApp\Core\Traits\Labels;
use BasicApp\Core\Traits\Configurable;
use BasicApp\Core\Interfaces\SettingsInterface;
use BasicApp\Core\Interfaces\ConfigurableInterface;

abstract class SettingsCell extends BaseCell 
    implements SettingsInterface,
        ConfigurableInterface
{
    use Settings, Labels, Configurable;

    protected $settings;

    protected $configClass;

    public function __construct()
    {
        if ($this->configClass)
        {
            $this->loadConfig();
        }

        helper(['get_short_class']);

        $this->settings ??= get_short_class($this);

        $this->loadSettings();
    }

    public function rules() : array
    {
        return [];
    }

    public function save() : bool
    {
        $this->saveSettings();

        return true;
    }
}
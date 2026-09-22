<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use BasicApp\Core\Interfaces\SettingsInterface;
use BasicApp\Core\Interfaces\FormInterface;
use BasicApp\Core\Traits\Settings as SettingsTrait;
use BasicApp\Core\Traits\Form;
use CodeIgniter\Traits\PropertiesTrait;

abstract class Settings implements SettingsInterface, FormInterface
{
    use SettingsTrait, Form, PropertiesTrait;

    public function __construct()
    {
        $this->fill($this->getSettings());
    }

    public function save(&$errors = null) : bool
    {
        $this->setSettings();

        return true;
    }
}
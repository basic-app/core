<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\View\Cells\Cell;
use BasicApp\Core\Traits\Settings;
use BasicApp\Core\Traits\Form;
use BasicApp\Core\Interfaces\SettingsInterface;
use BasicApp\Core\Interfaces\FormInterface;

abstract class SettingsCell extends Cell implements SettingsInterface, FormInterface
{
    use Settings, Form;

    public function __construct()
    {
        $values = $this->getSettings();

        $this->fill($values);
    }

    public function save(&$errors = null) : bool
    {
        $this->setSettings();

        return true;
    }
}
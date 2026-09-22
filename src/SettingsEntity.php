<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use BasicApp\Core\Interfaces\SettingsInterface;
use BasicApp\Core\Interfaces\FormInterface;
use BasicApp\Core\Traits\Settings;
use BasicApp\Core\Traits\Form;

abstract class SettingsEntity extends Entity implements SettingsInterface, FormInterface
{
    use Settings, Form;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->fill($this->getSettings(null, array_keys($this->attributes)));

        $this->syncOriginal();
    }

    public function save(&$errors = null) : bool
    {
        $this->setSettings(null, $this->attributes);

        return true;
    }
} 
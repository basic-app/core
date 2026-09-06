<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Interfaces;

interface SettingsInterface
{
    public function loadSettings();

    public function saveSettings();
}
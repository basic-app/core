<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use Exception;

class Composer extends \Composer\Installer\LibraryInstaller
{
    public static function postCreateProject($event)
    {        
        static::runCommands($event, 'BasicApp\Core\Composer::postCreateProject');
    }

    public static function postInstall($event)
    {
        static::runCommands($event, 'BasicApp\Core\Composer::postInstall');
    }

    public static function postUpdate($event)
    {
        static::runCommands($event, 'BasicApp\Core\Composer::postUpdate');
    }

    protected static function runCommands($event, $extraKey)
    {
        $params = $event->getComposer()->getPackage()->getExtra();
  
        if (isset($params[$extraKey]) && is_array($params[$extraKey]))
        {
            foreach ($params[$extraKey] as $method => $args)
            {
                call_user_func_array([__CLASS__, $method], (array) $args);
            }
        }
    }

    protected static function copy($files)
    {
        foreach($files as $source => $target)
        {
            copy($source, $target);
        }
    }

    protected static function setPermission($files)
    {
        foreach($files as $file => $permission)
        {
            chmod($file, octdec($permission));  
        }
    }
}
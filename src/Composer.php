<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use Exception;
use CodeIgniter\CLI\CLI;

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

            $source = CLI::color($source, 'green');
            $target = CLI::color($target, 'green');

            CLI::write('  - Copying ' . $source . ' to ' . $target);
        }
    }

    protected static function setPermission($files)
    {
        foreach($files as $file => $permission)
        {
            chmod($file, octdec($permission));

            $permission = CLI::color($permission, 'yellow');

            $file = CLI::color($file, 'green');
            
            CLI::write('  - Setting ' . $permission . ' permissions to ' . $file);
        }
    }
}
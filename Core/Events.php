<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\Events\Events as BaseEvents;

class Events extends BaseEvents
{

    const EVENT_PRE_SYSTEM = 'pre_system';

    const EVENT_POST_CONTROLLER_CONSTRUCTOR = 'post_controller_constructor';

    const EVENT_POST_SYSTEM = 'post_system';

    const EVENT_EMAIL = 'email';

    const EVENT_DB_QUERY = 'DBQuery';

    const EVENT_MIGRATE = 'migrate';

    public static function onPreSystem($callback)
    {
        return static::on(static::EVENT_PRE_SYSTEM, $callback);
    }

    public static function onPostControllerConstructor($callback)
    {
        return static::on(static::EVENT_POST_CONTROLLER_CONSTRUCTOR, $callback);
    }

    public static function onPostSystem($callback)
    {
        return static::on(static::EVENT_POST_SYSTEM, $callback);
    }

    public static function onEmail($callback)
    {
        return static::on(static::EVENT_EMAIL, $callback);
    }

    public static function onDbQuery($callback)
    {
        return static::on(static::EVENT_DB_QUERY, $callback);
    }

    public static function onMigrate($callback)
    {
        return static::on(static::EVENT_MIGRATE, $callback);
    }

}
<?php
/**
 * @author Basic App Dev Team <dev@basic-app.con>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Traits;

use Exception;

trait BehaviorsTrait
{

	protected $_behaviors = [];

	public function behaviors()
	{
		return [];
	}

	public function createBehavior(string $class, array $params = [])
	{
		return $class::factory($params);
	}

	public function as(string $name)
	{
		if (!array_key_exists($name, $this->_behaviors))
		{
			$config = $this->behaviors();

			if (!array_key_exists($name, $config))
			{
				throw new Exception('Behavior not defined: ' . $name);
			}

			if (!array_key_exists('class', $config[$name]))
			{
				throw new Exception('Behavior class not defined: ' . $name);
			}

			$class = $config[$name]['class'];

			unset($config[$name]['class']);

			$params = $config[$name];

			$params['owner'] = $this;

			$this->_behaviors[$name] = $this->createBehavior($class, $params);
		}

		return $this->_behaviors[$name];
	}

    public function getCurrentBehaviors()
    {
        $return = [];

        foreach(array_keys($this->behaviors()) as $behavior)
        {
            $return[$behavior] = $this->as($behavior);
        }

        return $return;
    }

}
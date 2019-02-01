<?php
/**
 * @package Basic App Core
 * @license MIT License
 * @link    http://basic-app.com
 */
namespace BasicApp\Core;

use CodeIgniter\Security\Exceptions\SecurityException;

abstract class BaseController extends \CodeIgniter\Controller
{

    const LOGGED_ROLE = '*';

    protected $authClass;

    protected $roles = [];

	protected $layout;

	protected $viewPath = '';

	protected $layoutPath = '';

	public function __construct()
	{
        $this->checkAccess($this->roles);
	}

    public function checkAccess(array $roles)
    {
        if ($roles)
        {
            $authClass = $this->getAuthClass();

            $user = $authClass::getCurrentUser();

            if (!$user)
            {
                return redirect()->to($authClass::loginUrl());
            }

            foreach($roles as $role)
            {
                if ($role == static::LOGGED_ROLE)
                {
                    return;
                }

                if ($user->hasPermission($role))
                {
                    return;
                }
            }

            throw SecurityException::forDisallowedAction();
        }
    }

	public function render(string $view, array $params = [])
	{
        $viewPath = $this->viewPath;

        if ($viewPath)
        {
            $viewPath .= '/';
        }

		$content = app_view($viewPath . $view, $params, ['saveData' => true]);

        $layoutPath = $this->layoutPath;

        if ($layoutPath)
        {
            $layoutPath .= '/';
        }

		if ($this->layout)
		{
			return app_view($layoutPath . $this->layout, ['content' => $content]);
		}

		return $content;
	}

}
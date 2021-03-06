<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Exceptions;

abstract class BaseForbiddenException extends \CodeIgniter\Exceptions\PageNotFoundException
{

	/**
	 * Error code
	 *
	 * @var integer
	 */
	protected $code = 403;
	
	public static function forDisallowedAction($action = null)
	{
		return new static(lang('HTTP.disallowedAction'), 403);
	}

}
<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

abstract class BaseAuthFilter implements \CodeIgniter\Filters\FilterInterface
{
    public function __construct()
    {
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $loginUrl = site_url('user/login');

        $currentUrl = current_url();

        if ($currentUrl == $loginUrl)
        {
            return;
        }

        helper(['auth']);
        
        if (user_id())
        {
            return;
        }

        return Services::response()->redirect($loginUrl);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

}
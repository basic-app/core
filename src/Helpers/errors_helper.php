<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
use CodeIgniter\Exceptions\PageNotFoundException;

if (!function_exists('show_404'))
{
    function show_404(?string $message = null)
    {
        throw PageNotFoundException::forPageNotFound($message);
    }
}
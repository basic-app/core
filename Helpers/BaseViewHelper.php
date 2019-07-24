<?php
/**
 * @package Basic App Core
 * @link http://basic-app.com
 * @license MIT License
 */
namespace BasicApp\Helpers;

abstract class BaseViewHelper
{

    public static function render(string $name, array $data = [], array $options = [])
    {
        $filename = APPPATH . 'Views/' . str_replace('\\', '/', $name) . '.php';

        if (is_file($filename))
        {
            $name = 'App\\' . $name;
        }

        return view($name, $data, $options);
    }

}
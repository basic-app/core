<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
if (!function_exists('render_view'))
{
    function render_view(
        string $view, 
        array $data = [], 
        ?array $options = null, 
        bool $saveData = false) : string
    {
        $newRenderer = service('renderer', null, null, false);

        $newRenderer->setData($data);

        return $newRenderer->render($view, $options, $saveData);
    }
}
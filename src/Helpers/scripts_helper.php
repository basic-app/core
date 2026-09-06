<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
use CodeIgniter\View\View;

if (!function_exists('render_scripts'))
{
    function render_scripts(?View $renderer = null) : string
    {
        $renderer = $renderer ?? service('renderer');

        $scripts = $renderer->getData()['scripts'] ?? [];

        return implode("\n", $scripts);
    }
}

if (!function_exists('add_script'))
{
    function add_script(?string $script, bool $unique = false, ?View $renderer = null) : void
    {
        if (!$script)
        {
            return;
        }

        $renderer = $renderer ?? service('renderer');

        $scripts = $renderer->getData()['scripts'] ?? [];

        if ($unique)
        {
            if (array_search($script, $scripts) !== false)
            {
                return;
            }
        }
        
        $scripts[] = $script;

        $renderer->setVar('scripts', $scripts);
    }
}
<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
use CodeIgniter\View\View;

if (!function_exists('render_styles'))
{
    function render_styles(?View $renderer = null) : string
    {
        $renderer = $renderer ?? service('renderer');

        $styles = $renderer->getData()['styles'] ?? [];

        return implode("\n", $styles);
    }
}

if (!function_exists('add_style'))
{
    function add_style(?string $style, bool $unique = false, ?View $renderer = null) : void
    {
        if (!$style)
        {
            return;
        }

        $renderer = $renderer ?? service('renderer');

        $styles = $renderer->getData()['styles'] ?? [];

        if ($unique)
        {
            if (array_search($style, $styles) !== false)
            {
                return;
            }
        }
        
        $styles[] = $style;

        $renderer->setVar('styles', $styles);
    }
}
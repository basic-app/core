<?php

namespace BasicApp\Validators;

class HtmlTagsValidator
{

    public function html_tags($str, $tags, $data, & $error = null) : bool
    {
        $new_string = strip_tags($str, $tags);

        if ($str != $new_string)
        {
            $error = t('errors', 'HTML tags allowed: {tags}', ['{tags}' => esc($tags)]);

            return false;
        }

        return true;
    }

}
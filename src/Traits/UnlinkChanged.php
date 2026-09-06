<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Traits;

trait UnlinkChanged
{
    public function unlinkChanged(array $attributes) : void
    {
        foreach($attributes as $attribute)
        {
            if ($this->hasChanged($attribute))
            {
                if (!empty($this->original[$attribute]))
                {
                    $filename = FCPATH . $this->original[$attribute];

                    if (is_file($filename))
                    {
                        unlink($filename);
                    }
                }
            }
        }
    }
}
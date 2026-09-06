<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Traits;

use CodeIgniter\Exceptions\PageNotFoundException;

trait Resource
{
    protected function findOrFail(int $id, string $message = null)
    {
        $return = $this->model->find($id);

        if (!$return)
        {
            throw PageNotFoundException::forPageNotFound($message);
        }

        return $return;
    }

    protected function createData(array $defaults = [])
    {
        $className = $this->model->returnType;

        if ($className == 'array')
        {
            return $defaults;
        }

        return new $className($defaults);
    }

    protected function saveData(&$data, &$errors = null)
    {
        $return = $this->model->save($data);

        if ($return)
        {
            if (!$this->model->getIdValue($data))
            {
                $data->{$this->model->id} = $this->model->getInsertID();
            }
        }
        else
        {
            $errors = $this->model->errors();
        }

        return $return;
    }
}
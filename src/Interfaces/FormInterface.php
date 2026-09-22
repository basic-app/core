<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Interfaces;

interface FormInterface
{
    public function fill(array $params);

    public function save(&$errors = null) : bool;

    public function rules() : array;

    public function labels() : array;
}
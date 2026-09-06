<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\Model as BaseModel;
use BasicApp\Core\Traits\Labels;

abstract class Model extends BaseModel
{
    use Labels;
    
    protected $table            = null;
    protected $primaryKey       = null;
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = true; // false
    protected bool $updateOnlyChanged = false; // true

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function rules() : array
    {
        return $this->validationRules; // need for labels trait
    }

    public function validate($row): bool
    {
        $rules = $this->validationRules;

        $this->validationRules = $this->rowValidationRules($row);

        $return = parent::validate($row);

        $this->validationRules = $rules;

        return $return;
    }

    public function rowValidationRules($row) : array
    {
        return $this->validationRules;
    }
}
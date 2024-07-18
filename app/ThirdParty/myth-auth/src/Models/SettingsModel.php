<?php

namespace Myth\Auth\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key', 'value'];
    protected $returnType = 'array';

    public function getValueByKey($key)
    {
        $result = $this->where('key', $key)->first();
        return $result ? $result['value'] : null;
    }
}

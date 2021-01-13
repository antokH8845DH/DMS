<?php

namespace App\Models;

use CodeIgniter\Model;

class MesinModel extends Model
{
    protected $table = 'mesin';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_mobil', 'id_user', 'status', 'km', 'problem_mesin', 'action_mesin', 'active', 'msn_created_date', 'msn_created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Mesin';
    protected $useTimestamps = false;
}

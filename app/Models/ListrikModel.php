<?php

namespace App\Models;

use CodeIgniter\Model;

class ListrikModel extends Model
{
    protected $table = 'listrik';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_mobil', 'id_user', 'km', 'status', 'problem_listrik', 'action_listrik', 'active', 'lst_created_date', 'lst_created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Listrik';
    protected $useTimestamps = false;
}

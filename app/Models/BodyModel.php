<?php

namespace App\Models;

use CodeIgniter\Model;

class BodyModel extends Model
{
    protected $table = 'body';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_mobil', 'id_user', 'km', 'status', 'problem_body', 'action_body', 'active', 'bdy_created_date', 'bdy_created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Body';
    protected $useTimestamps = false;
}

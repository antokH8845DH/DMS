<?php

namespace App\Models;

use CodeIgniter\Model;

class KakiModel extends Model
{
    protected $table = 'kaki';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_mobil', 'id_user', 'km', 'status', 'problem_kaki', 'action_kaki', 'active', 'kk_created_date', 'kk_created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Vehicle';
    protected $useTimestamps = false;
}

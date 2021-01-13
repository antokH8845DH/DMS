<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table = 'mobil';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nopol', 'merek', 'type', 'jenis', 'th_perakitan', 'tgl_stnk', 'active', 'created_date', 'created_by', 'updated_date', 'updated_by'
    ];
    protected $returnType = 'App\Entities\Vehicle';
    protected $useTimestamps = false;
}

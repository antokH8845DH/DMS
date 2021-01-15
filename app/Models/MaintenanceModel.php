<?php

namespace App\Models;

use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $table = 'maintenance';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_mobil', 'id_user', 'km', 'tanggal', 'status', 'detail', 'problem', 'action', 'active', 'maintenance_created_date', 'maintenance_created_by', 'maintenance_updated_date', 'maintenance_updated_by'
    ];
    protected $returnType = 'App\Entities\Maintenance';
    protected $useTimestamps = false;
}

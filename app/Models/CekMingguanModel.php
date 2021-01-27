<?php

namespace App\Models;

use CodeIgniter\Model;

class CekMingguanModel extends Model
{
    protected $table = 'cekMingguan';
    protected $primaryKey = 'idCek';
    protected $allowedFields = [
        'id_mobil', 'id_user', 'km', 'oliMesin', 'oliRem', 'airRadiator', 'airAki', 'airWiper', 'taliKipas', 'suaraMesin', 'kopling', 'stir',
        'ban', 'lampu', 'wiper', 'toolkit', 'body', 'interior', 'problem', 'action', 'maint_created_date', 'maint_created_by', 'maint_updated_date',
        'maint_updated_by', 'active', 'validasi', 'validasi_date', 'validasi_by'
    ];
    protected $returnType = 'App\Entities\CekMingguan';
    protected $useTimestamps = false;
}

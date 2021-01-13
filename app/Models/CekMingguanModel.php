<?php

namespace App\Models;

use CodeIgniter\Model;

class CekMingguanModel extends Model
{
    protected $table = 'cekMingguan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_mobil', 'id_user', 'km', 'oliMesin', 'oliRem', 'airRadiator', 'airAki', 'airWiper', 'taliKipas', 'suaraMesin', 'kopling', 'stir', 'tekananBan',
        'alurBan', 'lampu', 'wiper', 'problem', 'action', 'created_date', 'created_by', 'updated_date', 'updated_by', 'active'
    ];
    protected $returnType = 'App\Entities\CekMingguan';
    protected $useTimestamps = false;
}

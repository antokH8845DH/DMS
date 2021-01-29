<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadModel extends Model
{
    protected $table = 'upload';
    protected $primaryKey = 'id_upload';
    protected $allowedFields = [
        'no_form', 'original', 'image', 'active'
    ];
    protected $returnType = 'App\Entities\Upload';
    protected $useTimestamps = false;
}

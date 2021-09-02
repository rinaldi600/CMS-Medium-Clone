<?php

namespace App\Models;

use CodeIgniter\Model;

class UpdateModel extends Model
{
    protected $table      = 'activityupdate';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['idAuthor', 'idContent'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

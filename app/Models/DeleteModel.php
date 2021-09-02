<?php

namespace App\Models;

use CodeIgniter\Model;

class DeleteModel extends Model
{
    protected $table      = 'activitydelete';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['title', 'idAuthor'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
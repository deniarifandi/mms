<?php

namespace App\Models;

use CodeIgniter\Model;

class Students extends Model
{
  protected $table      = 'students'; // The name of the table
    protected $primaryKey = 'student_id'; // The primary key column

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; // Returns data as an array
    protected $useSoftDeletes = true; // Enable soft deletes if needed

    protected $allowedFields = ['name', 'email']; // Fields that can be inserted or updated

    protected $useTimestamps = false; // Set to true if you have 'created_at' and 'updated_at' fields
}
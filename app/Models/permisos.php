<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisos extends Model
{
    use HasFactory;

    // const CREATED_AT = 'created';
    // const UPDATED_AT = 'modified';

    
    protected $table = 'permisos';
    protected $primaryKey = 'id';
}

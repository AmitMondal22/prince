<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdUnit extends Model
{
    use HasFactory;
    protected $table = 'md_unit';
    protected $primaryKey = 'unit_id';
    protected $fillable = ["unit_name", "unit_size"];
}

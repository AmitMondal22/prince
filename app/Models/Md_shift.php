<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_shift extends Model
{
    use HasFactory;

    protected $table = 'md_shift';
    protected $primaryKey = 'shift_id';
    protected $fillable = ["employee_type", "work_time", "work_rate", "overtime_typpe", "overtime_rate", "created_by", "updated_by"];
}

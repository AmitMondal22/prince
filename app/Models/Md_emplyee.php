<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_emplyee extends Model
{
    use HasFactory;

    protected $table = 'md_employee';
    protected $primaryKey = 'employee_id';
    protected $fillable = ["employee_type", "employee_name", "employee_mobile", "employee_address", "update_by", "create_by"];
}

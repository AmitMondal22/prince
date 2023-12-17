<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Td_InOutTime extends Model
{
    use HasFactory;

    protected $table = 'td_employee_in_out';
    protected $primaryKey = 'employee_in_out_id';
    protected $fillable = ["employee_id", "shift_id", "in_time", "out_time", "date", "create_by", "update_by"];

}

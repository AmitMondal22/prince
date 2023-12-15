<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Md_customer extends Model
{
    use HasFactory;

    protected $table = 'md_customer';
    protected $primaryKey = 'customer_id';
    protected $fillable = ["customer_name", "mobile_no", "address"];
}

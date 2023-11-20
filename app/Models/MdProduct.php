<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdProduct extends Model
{
    use HasFactory;
    protected $table = 'md_product';
    protected $primaryKey = 'product_id';
    protected $fillable = ["product_name", "unit_id", "user_type", "qty"];
}

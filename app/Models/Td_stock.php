<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Td_stock extends Model
{
    use HasFactory;

    protected $table = 'td_stock';
    protected $primaryKey = 'stock_id';
    protected $fillable = ["product_id", "user_id", "qty", "unit_id", "create_by"];
}

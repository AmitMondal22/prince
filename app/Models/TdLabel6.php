<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel6 extends Model
{
    use HasFactory;
    protected $table = 'td_label6';
    protected $primaryKey = 'label6_id';
    protected $fillable = ["create_by", "l6_qty", "product_mastar_id", "l6_stock", "l6_flag", "update_by"];
}

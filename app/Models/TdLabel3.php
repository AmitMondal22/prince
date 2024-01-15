<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel3 extends Model
{
    use HasFactory;
    protected $table = 'td_label3';
    protected $primaryKey = 'label3_id';
    protected $fillable = ["create_by", "l3_qty", "batch_no", "l3_stock", "l3_flag", "update_by"];
    // protected $fillable = ["create_by", "l3_qty", "product_mastar_id", "l3_stock", "l3_flag", "update_by"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel4 extends Model
{
    use HasFactory;
    protected $table = 'td_label4';
    protected $primaryKey = 'label4_id';
    protected $fillable = ["create_by", "l3_id", "batch_no","update_by"];


    // protected $fillable = ["create_by", "l4_qty", "product_mastar_id", "l4_stock", "l4_flag", "update_by"];
}

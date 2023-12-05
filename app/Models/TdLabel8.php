<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel8 extends Model
{
    use HasFactory;
    protected $table = 'td_label8';
    protected $primaryKey = 'label8_id';
    protected $fillable = ["create_by", "l8_qty", "product_mastar_id", "l8_stock", "l8_flag", "update_by"];
}

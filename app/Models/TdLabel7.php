<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel7 extends Model
{
    use HasFactory;
    protected $table = 'td_label7';
    protected $primaryKey = 'label7_id';
    protected $fillable = ["create_by", "l7_qty", "product_mastar_id", "l7_stock", "l7_flag", "update_by"];
}

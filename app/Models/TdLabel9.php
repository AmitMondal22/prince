<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel9 extends Model
{
    use HasFactory;
    protected $table = 'td_label9';
    protected $primaryKey = 'label9_id';
    protected $fillable = ["create_by", "l9_qty", "product_mastar_id", "l9_stock", "l9_flag", "update_by"];
}

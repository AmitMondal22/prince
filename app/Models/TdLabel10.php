<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel10 extends Model
{
    use HasFactory;
    protected $table = 'td_label10';
    protected $primaryKey = 'label10_id';
    protected $fillable = ["create_by", "l10_qty", "product_mastar_id", "l10_stock", "l10_flag", "update_by"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel5 extends Model
{
    use HasFactory;
    protected $table = 'td_label5';
    protected $primaryKey = 'label5_id';
    protected $fillable = ["create_by", "l5_qty", "product_mastar_id", "l5_stock", "l5_flag", "update_by"];
}

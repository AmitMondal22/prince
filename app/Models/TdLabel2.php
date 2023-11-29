<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel2 extends Model
{
    use HasFactory;
    protected $table = 'td_label2';
    protected $primaryKey = 'label2_id';
    protected $fillable = ["create_by", "l2_qty", "product_mastar_id", "l2_stock", "l2_flag", "update_by"];
}

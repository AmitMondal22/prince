<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel1 extends Model
{
    use HasFactory;

    protected $table = 'td_label1';
    protected $primaryKey = 'label1_id';
    protected $fillable = ["create_by", "l1_qty", "product_mastar_id", "l1_stock", "l1_flag", "update_by"];
}

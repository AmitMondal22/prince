<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdLabel1 extends Model
{
    use HasFactory;

    protected $table = 'td_label1';
    protected $primaryKey = 'label1_id';
    protected $fillable = ["create_by", "l1_qty", "product_mastar_id", "batch_no", "product_id", "l1_stock", "l1_flag", "update_by"];


    public static function getLastBatchNoValue()
    {
        // Retrieve the last batch_no value
        $lastBatchNo = self::orderBy('created_at', 'desc')->value('batch_no');

        // Return 0 if the value is null
        return $lastBatchNo ?? 0;
    }

    public function masterProduct()
    {
        return $this->belongsTo(MD_MasterProduct::class, 'product_mastar_id', 'id_master_product');
    }

}

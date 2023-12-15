<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Td_sels extends Model
{
    use HasFactory;

    protected $table = 'td_sels';
    protected $primaryKey = 'sels_id';
    protected $fillable = ["customer_id", "mrp", "discount", "cgst", "sgst", "amount", "qty", "hsncode", "product_id", "billint_id", "create_by", "update_by"];
}

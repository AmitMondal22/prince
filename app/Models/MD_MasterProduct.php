<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MD_MasterProduct extends Model
{
    use HasFactory;
    protected $table = 'md_master_product';
    protected $primaryKey = 'id_master_product';
    protected $fillable = ["product_name"];
}

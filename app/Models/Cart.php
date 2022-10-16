<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
 
    public function rProduct()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

}

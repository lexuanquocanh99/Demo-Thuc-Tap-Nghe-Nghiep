<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsAttributesValues extends Model
{
    protected $fillable = ['product_id','attribute_id','attribute_value_id'];
}

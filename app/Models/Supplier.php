<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    #mass assignment rule in appserviceprovider
    // protected $fillable = ['company name', 'etc'];

    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class, 'supplier_id');
    }
}

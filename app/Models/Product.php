<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'stock',
        'subcategory_id'
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function variants(){
        return $this->hasMany(Variant::class);
    }

    public function options(){
        return $this->belongsToMany(Option::class)->using(OptionProduct::class)->withPivot('features')->withTimestamps();
    }
}

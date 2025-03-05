<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'description',
        'option_id'
    ];

    public function option(){
        return $this->belongsTo(Option::class);
    }

    public function variants(){
        return $this->belongsToMany(Variant::class)->withTimestamps();
    }
}

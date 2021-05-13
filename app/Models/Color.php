<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('stock');
    }

    protected $fillable = [
        'nameFr', 'nameAr' , 'value',
    ];
}

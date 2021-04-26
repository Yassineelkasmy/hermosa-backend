<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }

    public function pictures() {
        return $this->hasMany(Picture::class);
    }

    public function colors() {
        return $this->hasMany(Color::class)->withPivot('stock');
    }

    public function sizes() {
        return $this->hasMany(Size::class);
    }


    protected $fillable = [
        'title_fr','desc_fr','title_ar','desc_ar','price','stock',
    ];
}

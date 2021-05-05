<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function pictures() {
        return $this->hasMany(Picture::class);
    }

    public function colors() {
        return $this->belongsToMany(Color::class)->withPivot('stock');
    }

    public function sizes() {
        return $this->belongsToMany(Size::class);
    }

    public function getStockAttribute() {
        $sum = 0;
        foreach($this->colors as $color) {
            $sum += $color->pivot->stock;
        }

        return $sum;
    }

    protected $fillable = [
        'title_fr','desc_fr','title_ar','desc_ar','price',
    ];

    public static function boot(){
        parent::boot();
        static::deleting(function ($product) {
            $product->colors()->detach();
            $product->sizes()->detach();
            $product->categories()->detach();
            $product->tags()->detach();
        });
    }
}

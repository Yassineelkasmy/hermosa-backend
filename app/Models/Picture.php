<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'filename','color_id'
      ];

    public function thumbnail_url() {
        return  asset("thumbnails/".$this->filename);
    }
    public function image_url() {
        return  asset("images/".$this->filename);
    }



}

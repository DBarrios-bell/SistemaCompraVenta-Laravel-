<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','barcode','cost','price','stock','alerts','image','category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getImagenAttribute(){
        if($this->image != null)
            return (file_exists('storage/products/' . $this->image) ? $this->image : 'blank.jpeg');
        else
            return 'blank.jpeg';
    }
}

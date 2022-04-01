<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =['name','image','pventa_id'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getImagenAttribute(){
        if($this->image != null)
            return (file_exists('storage/categories/' . $this->image) ? $this->image : 'blank.jpeg');
        else
            return 'blank.jpeg';

            //hace lo mismo que el de arriba
    //     if($this->image != NULL)
    //          {
    //             if(file_exists('storage/categorias/' . $this->image))
    //                 return $this->image;
    //             else
    //                 return 'blank.jpeg';
    //          }else{
    //              return 'blank.jpeg';
    //          }
    }

}

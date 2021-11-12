<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\ProductImage;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];


    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id')->withTimestamps();
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    
    public function productSizes(){
        return $this->hasMany(ProductSize::class,'product_id');
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class,'product_id');
    }
 
}

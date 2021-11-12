<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    
    protected $guarded = []; 
    protected $table = 'feedbacks';
    protected $fillable = ['product_id','user_id','feedback','star'];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

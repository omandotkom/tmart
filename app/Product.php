<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ="products";
    protected $fillable = ['name', 'description','price','stock','image','weight','category_id'];
    public function comments(){
        return $this->hasMany('App\Comment','product_id','id');
    }
    public function categoryproduct(){
        return $this->hasOne('App\Category','id','product_id');
    }
    
}

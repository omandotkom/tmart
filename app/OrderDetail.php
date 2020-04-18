<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";
    protected $fillable = ['order_id','product_id','product_quantity'];
    protected function product(){
        return $this->hasOne('App\Product','id',"product_id");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = ["user_id","status","image","trackingnumber","grandtotal","courier","name","province","city","postalcode","address","phone "];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function detil(){
        return $this->hasMany('App\OrderDetail','order_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderShipments extends Model
{
    protected $table = "order_shipments";
    protected $fillable = ["order_id","name","type","price"];
}

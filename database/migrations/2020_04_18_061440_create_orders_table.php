<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->enum('status', ['PaymentWaitingConfirmation', 'PaymentConfirmed','Shipped','Done']);
            $table->text('trackingnumber')->default("-");
            $table->double('grandtotal')->default(0);
            $table->string('courier');	
            $table->string("name");
            $table->string('phone');
            $table->text('image');
            $table->string('province');
            $table->string('city');
            $table->string('postalcode');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcspecs', function (Blueprint $table) {
            $table->increments('pc_id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->text('cpu');
            $table->text('motherboard');
            $table->text('gpu');
            $table->text('ram');
            $table->text('hdd');
            $table->text('sdd');
            $table->text('psu');
            $table->text('pc_case');
            $table->text('imagePath')->default('images/default-pc.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcspecs');
    }
};

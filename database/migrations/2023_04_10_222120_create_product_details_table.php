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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned()->unique();
            $table->boolean('show_slider')->default(0);
            $table->boolean('show_opportunity_day')->default(0);
            $table->boolean('show_featured')->default(0);
            $table->boolean('show_bestseller')->default(0);
            $table->boolean('show_discount')->default(0);

            /* $table->foreign('product_id')->references('id')->on('products');//->onDelete('cascade');
          // bizim sorunumuz tam olarak bu kısımda burda yapılan işlemde hata alıyoruz sql hatası
          */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
};

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
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();



           /* $table->foreign('category_id')->references('id')->on('categories');//->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');//->onDelete('cascade');
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
        Schema::dropIfExists('category_product');
    }
};

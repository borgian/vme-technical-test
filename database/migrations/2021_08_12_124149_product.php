<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('barcode');
            $table->string('brand')->nullable()->default('');
            $table->double('price');
            $table->text('image_url')->nullable();
            $table->integer('date_added')->useCurrent()->nullable();
            $table->integer('updated_at')->useCurrent()->nullable();
            $table->integer('created_at')->useCurrent()->nullable();
            $table->boolean('is_import')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}

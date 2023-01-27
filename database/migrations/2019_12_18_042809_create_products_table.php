<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('asignable_id')->unsigned();
            $table->string('sn')->unique();
            $table->integer('activo_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->string('image')->nullable();
            $table->string('qty');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('asignable_id')->references('id')->on('asignables')->onDelete('cascade');
            $table->foreign('activo_id')->references('id')->on('activos')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

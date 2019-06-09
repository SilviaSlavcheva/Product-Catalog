<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name', 20);
            $table->text('description');
            $table->decimal('price')->unsigned()->nullable()->comment('Product\'s price');;
            $table->boolean('active')->unsigned()->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_user_id_foreign');
        });

        Schema::dropIfExists('products');
    }
}

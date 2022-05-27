<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertismentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img');
            $table->double('price');
            $table->text('desc')->nullable();

            $table->integer('cat_id');
            $table->integer('subcat_id');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('user_id')->nullable();

            $table->boolean('active')->default(0);
            $table->boolean('featured')->default(0);

            $table->enum('Condition', ['used', 'new']);
            $table->enum('type', ['sale', 'buy']);


            $table->string('auth_name')->nullable();
            $table->string('auth_email')->nullable();
            $table->string('auth_phone')->nullable();
            $table->string('auth_address')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('advertisments');
    }
}

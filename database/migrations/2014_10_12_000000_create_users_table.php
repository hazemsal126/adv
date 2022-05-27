<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('snapshat')->nullable();
            $table->string('telegram')->nullable();
            $table->string('website')->nullable();

            $table->string('img')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();

            $table->boolean('isadmin')->default(0);
            $table->enum('type',[0,1,2]);
            $table->boolean('is_terms')->defaul(0);
            $table->string('fcm')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

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
            $table->string('username');
            $table->string('email')->unique();
            $table->string("profile")->default("https://icon-library.com/images/default-profile-icon/default-profile-icon-24.jpg");
            $table->timestamp('email_verified_at')->nullable();
            $table->string("background")->default("https://i.pinimg.com/originals/67/42/8f/67428feb0ecce36d48f4fea3560d19c0.png");
            $table->text("bio")->nullable();
            $table->string('password');
            $table->string('phone');
            $table->rememberToken();
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

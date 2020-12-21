<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('dni')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();

            $table->string('role'); // 'admin', 'patient', 'doctor'

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('work_days', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedSmallInteger('day');
            $table->boolean('active');

            $table->time('morning_start');
            $table->time('morning_end');

            $table->time('afternoon_start');
            $table->time('afternoon_end');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('work_days');
        Schema::dropIfExists('users');
    }
}

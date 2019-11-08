<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsrUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usr_user', function (Blueprint $table) {
            $table->integer('user_id', true, false);
            $table->string('email_login', 80);
            $table->string('password_encrypted', 80);

//            $table->string('google_id', 80)->nullable();
//            $table->string('facebook_id', 80)->nullable();
            $table->string('user_type_code_abbr', 80);
            $table->string('device_token', 255)->nullable();
            $table->string('platform', 80)->nullable();
            $table->date('effective_start_date')->nullable();
            $table->date('effective_end_date')->nullable();
            $table->string('remember_token', 255)->nullable();

            $table->integer('created_by')->nullable();
            $table->datetime('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->integer('program_created_by')->nullable();
            $table->datetime('program_created_at')->nullable();
            $table->integer('program_updated_by')->nullable();
            $table->datetime('program_updated_at')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('usr_user');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

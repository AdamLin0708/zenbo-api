<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookupCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_code', function (Blueprint $table) {
            $table->integer('code_id', true, false);
            $table->string('type_abbr', 32);
            $table->string('code_abbr', 80);
            $table->string('name', 32)->nullable();

            $table->integer('created_by')->nullable();
            $table->datetime('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->integer('program_created_by')->nullable();
            $table->datetime('program_created_at')->nullable();
            $table->integer('program_updated_by')->nullable();
            $table->datetime('program_updated_at')->nullable();

            $table->index('code_abbr');

            $table->foreign('type_abbr')->references('type_abbr')->on('lookup_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lookup_code');
    }
}

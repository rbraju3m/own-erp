<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('discription')->nullable();
            $table->string('file_link', 128)->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('file_day', 50)->nullable();
            $table->string('file_month', 50)->nullable();
            $table->string('file_year', 50)->nullable();
            $table->string('file_time', 50)->nullable();
            $table->string('file_date', 50)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
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
        Schema::dropIfExists('file');
    }
}

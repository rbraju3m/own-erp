<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('discription')->nullable();
            $table->string('image_link', 128)->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('image_day', 50)->nullable();
            $table->string('image_month', 50)->nullable();
            $table->string('image_year', 50)->nullable();
            $table->string('image_time', 50)->nullable();
            $table->string('image_date', 50)->nullable();
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
        Schema::dropIfExists('gallery');
    }
}

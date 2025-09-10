<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbr_safe__member', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('member_id')->nullable();
            $table->string('national_id')->nullable();
            $table->string('f_h_name')->nullable();
            $table->string('nominee')->nullable();
            $table->string('nominee_mobile')->nullable();
            $table->string('nominee_n_id')->nullable();
            $table->text('present_address')->nullable();
            $table->text('parmanent_address')->nullable();
            $table->string('image_link', 128)->nullable();
            $table->enum('type', ['Admin', 'Chairman', 'General secretary', 'Member'])->nullable();
            $table->enum('religion', ['Islam', 'Hinduism', 'Christianity', 'Buddhism'])->nullable();
            $table->enum('gender', ['Male', 'Female', 'Others'])->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('join_day', 50)->nullable();
            $table->string('join_month', 50)->nullable();
            $table->string('join_year', 50)->nullable();
            $table->string('join_time', 50)->nullable();
            $table->string('join_date', 50)->nullable();
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
        Schema::dropIfExists('member');
    }
}

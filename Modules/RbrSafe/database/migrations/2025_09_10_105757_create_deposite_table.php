<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbr_safe__deposit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->string('month', 50)->nullable();
            $table->string('year', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->text('note')->nullable();
            $table->string('amount', 50)->nullable();
            $table->string('payment_day', 50)->nullable();
            $table->string('payment_month', 50)->nullable();
            $table->string('payment_year', 50)->nullable();
            $table->string('payment_time', 50)->nullable();
            $table->string('payment_date', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();

            $table->foreign('member_id', 'deposite_member_id_foreign')->references('id')->on('rbr_safe__member')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposite');
    }
}

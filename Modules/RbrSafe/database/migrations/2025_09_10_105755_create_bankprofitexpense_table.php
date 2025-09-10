<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankprofitexpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbr_safe__bank_profit_expense', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('amount')->nullable();
            $table->string('ex_date')->nullable();
            $table->text('note')->nullable();
            $table->string('image_link', 128)->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('expense_day', 50)->nullable();
            $table->string('expense_month', 50)->nullable();
            $table->string('expense_year', 50)->nullable();
            $table->string('expense_time', 50)->nullable();
            $table->string('expense_date', 50)->nullable();
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
        Schema::dropIfExists('bankprofitexpense');
    }
}

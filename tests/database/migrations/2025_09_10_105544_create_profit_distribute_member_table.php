<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitDistributeMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_distribute_member', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profit_id');
            $table->unsignedBigInteger('member_id');
            $table->double('deposit_amount', 10, 2)->nullable();
            $table->double('profit_amount', 10, 2)->nullable();
            $table->timestamps();
            
            $table->foreign('member_id', 'profit_distribute_member_member_id_foreign')->references('id')->on('member')->onDelete('cascade');
            $table->foreign('profit_id', 'profit_distribute_member_profit_id_foreign')->references('id')->on('profit_distribute')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profit_distribute_member');
    }
}

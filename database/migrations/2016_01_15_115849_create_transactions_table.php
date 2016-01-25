<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('payment_gateway_id')->unsigned();
            $table->string('currency', 3);
            $table->decimal('amount')->default(0);
            $table->decimal('balance')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
            $table->foreign('type_id')
                ->references('id')
                ->on('transaction_types')
                ->onDelete('cascade');
            $table->foreign('payment_gateway_id')
                ->references('id')
                ->on('payment_gateways')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}

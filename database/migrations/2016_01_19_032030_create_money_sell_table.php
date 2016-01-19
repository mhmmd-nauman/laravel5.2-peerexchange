<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneySellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_sell', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->string('from_currency', 3);
            $table->string('to_currency', 3);
            $table->decimal('amount');
            $table->decimal('rate');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->integer('money_sell_id')->unsigned()->nullable()->after('payment_gateway_id');
            $table->foreign('money_sell_id')
                ->references('id')
                ->on('money_sell')
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
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign('transactions_money_sell_id_foreign');
        });
        Schema::drop('money_sell');
    }
}

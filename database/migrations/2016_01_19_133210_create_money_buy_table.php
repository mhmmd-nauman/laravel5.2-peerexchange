<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_buy', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->integer('money_sell_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->foreign('money_sell_id')
                ->references('id')
                ->on('money_sell')
                ->onDelete('cascade');
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->integer('money_buy_id')->unsigned()->nullable()->after('money_sell_id');
            $table->foreign('money_buy_id')
                ->references('id')
                ->on('money_buy')
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
            $table->dropForeign('transactions_money_buy_id_foreign');
        });
        Schema::drop('money_buy');
    }
}

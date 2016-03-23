<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobDobAddressUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
             $table->string('mobile', 20);
             $table->string('nationalid', 30);
             //$table->string('nationalid', 30);
             $table->date('dob');
             $table->string('personal_bank_account', 30);
             $table->string('receiver_bank_account', 30);
             $table->string('receiver_bank_account_name', 30);
             $table->string('receiver_country_code', 2)->nullable();
             $table->mediumText('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

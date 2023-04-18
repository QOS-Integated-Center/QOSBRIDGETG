<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_holders', function (Blueprint $table) {
            $table->id();
            $table->string('clientid');
            $table->string('msisdn');
            $table->string('firstName');
            $table->string('surName');
            $table->enum('accountholderstatus', ['ACTIVE', 'ACCOUNTHOLDER_DELETED', 'ACCOUNTHOLDER_NOT_FOUND'])->default('ACTIVE');
            $table->string('responsecode')->nullable();
            $table->string('responsemsg')->nullable();
            $table->text('personalInformation')->nullable();
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
        Schema::dropIfExists('account_holders');
    }
}

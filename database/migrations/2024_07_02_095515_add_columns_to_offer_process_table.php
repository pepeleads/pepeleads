<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOfferProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_processes', function (Blueprint $table) {
            $table->string('click_id')->nullable();
            $table->string('unique1')->nullable();
            $table->string('unique2')->nullable();
            $table->string('unique3')->nullable();
            $table->string('unique4')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_processes', function (Blueprint $table) {
            $table->dropColumn('click_id');
            $table->dropColumn('unique1');
            $table->dropColumn('unique2');
            $table->dropColumn('unique3');
            $table->dropColumn('unique4');
        });
    }
}

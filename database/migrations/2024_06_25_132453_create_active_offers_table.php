<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('camp_id');
            $table->string('network');
            $table->unsignedBigInteger('user_id');
            $table->boolean('approved_status')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            // Add foreign key constraints if necessary
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_offers');
    }
}

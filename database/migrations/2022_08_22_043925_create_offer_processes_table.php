<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use SoftDeletes;
    public function up()
    {
        Schema::create('offer_processes', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('offer_id')->nullable();
            $table->string('offer_name')->nullable();
            $table->string('hash_code')->nullable();
            $table->string('status')->nullable();
            $table->string('start_ip')->nullable();
            $table->string('end_ip')->nullable();
            $table->string('credit')->nullable();
            $table->string('ref_credit')->nullable();
            $table->string('network')->nullable();
            $table->string('link_id')->nullable();
            $table->string('credit_mode')->nullable();
            $table->string('source')->nullable();
            $table->string('unique')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('start_country')->nullable();
            $table->string('end_country')->nullable();
            $table->string('sid1')->nullable();
            $table->string('sid2')->nullable();
            $table->string('sid3')->nullable();
            $table->string('sid4')->nullable();
            $table->string('sid5')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_processes');
    }
}

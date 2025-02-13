<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     use SoftDeletes;
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('image_url')->nullable();
            $table->string('hash_code')->nullable();
            $table->string('network')->nullable();
            $table->string('credit')->nullable();
            $table->string('active')->nullable();
            $table->string('hits')->nullable();
            $table->string('limit')->nullable();
            $table->longText('target_url')->nullable();
            $table->string('countries')->nullable();
            $table->string('leads')->nullable();
            $table->string('date')->nullable();
            $table->string('epc')->nullable();
            $table->string('mobile')->nullable();
            $table->string('categories')->nullable();
            $table->string('web')->nullable();
            $table->string('cr')->nullable();
            $table->string('browser')->nullable();
            $table->string('uid')->nullable();
            $table->string('views')->nullable();
            $table->string('convert')->nullable();
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
        Schema::dropIfExists('offers');
    }
}

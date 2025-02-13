<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     use SoftDeletes;
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('site_name');
            $table->string('domain_name');
            $table->longText('post_back');
            $table->string('virtual_currency');
            $table->string('currency_value');
            $table->longText('description');
            $table->string('status');
            $table->string('api_key');
            $table->string('secret_key');
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
        Schema::dropIfExists('sites');
    }
}

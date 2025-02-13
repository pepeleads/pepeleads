<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use SoftDeletes;
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('aff_sub_1')->nullable();
            $table->string('aff_sub_2')->nullable();
            $table->string('aff_sub_3')->nullable();
            $table->string('aff_sub_4')->nullable();
            $table->string('offer_id')->nullable();
            $table->string('ad_id')->nullable();
            $table->string('conversion_status')->nullable();
            $table->string('commission')->nullable();
            $table->string('user_commission')->nullable();
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
        Schema::dropIfExists('leads');
    }
}

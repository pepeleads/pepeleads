<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostbackResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use SoftDeletes;
    public function up()
    {
        Schema::create('postback_responses', function (Blueprint $table) {
            $table->id();
            $table->string('network')->nullable();
            $table->string('aff_sub_1')->nullable();
            $table->string('aff_sub_2')->nullable();
            $table->string('aff_sub_3')->nullable();
            $table->longText('response')->nullable();
            $table->string('hash_code')->nullable();
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
        Schema::dropIfExists('postback_responses');
    }
}

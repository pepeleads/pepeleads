<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferwallUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use SoftDeletes;
    public function up()
    {
        Schema::create('offerwall_users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('api_key');
            $table->string('user_id');
            $table->string('gender');
            $table->string('dob_day');
            $table->string('dob_month');
            $table->string('dob_year');
            $table->string('ethnicity');
            $table->string('country');
            $table->string('state');
            $table->string('pincode');
            $table->string('merital_status');
            $table->string('education');
            $table->string('employment_status');
            $table->string('earning');
            $table->string('industry');
            $table->string('Illness');
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
        Schema::dropIfExists('offerwall_users');
    }
}

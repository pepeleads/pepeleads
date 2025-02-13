<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Adding new fields
            $table->string('companyName')->nullable();
            $table->string('website')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('title')->nullable();
            $table->text('question1')->nullable();
            $table->text('question2')->nullable();
            $table->text('question3')->nullable();
            $table->text('question4')->nullable();
            $table->text('question5')->nullable();
            $table->text('question6')->nullable();
            $table->text('question7')->nullable();
            $table->string('skype')->nullable();
            $table->string('linkedin')->nullable();
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
            // Dropping fields in case of rollback
            $table->dropColumn([
                'companyName',
                'website',
                'state',
                'zipcode',
                'title',
                'question1',
                'question2',
                'question3',
                'question4',
                'question5',
                'question6',
                'question7',
                'question8',
                'question9',
                'skype',
                'linkedin',
            ]);
        });
    }
}

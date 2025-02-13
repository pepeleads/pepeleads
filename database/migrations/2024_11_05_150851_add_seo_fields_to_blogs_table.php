<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoFieldsToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_schema')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('no_index')->default(false);
            $table->boolean('no_follow')->default(false);
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->json('structured_data')->nullable();
            $table->string('breadcrumb_title')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('meta_publisher')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->boolean('shareable')->default(true);
            $table->integer('share_count')->default(0);
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            $table->text('custom_headers')->nullable();
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
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_schema')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('no_index')->default(false);
            $table->boolean('no_follow')->default(false);
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->json('structured_data')->nullable();
            $table->string('breadcrumb_title')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('meta_publisher')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->boolean('shareable')->default(true);
            $table->integer('share_count')->default(0);
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            $table->text('custom_headers')->nullable();
            $table->softDeletes();
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blogs extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'blogbanner',
        'status',
        'created_at',
        'updated_at',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_schema',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'no_index',
        'no_follow',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'structured_data',
        'breadcrumb_title',
        'meta_author',
        'meta_publisher',
        'og_type',
        'og_url',
        'shareable',
        'share_count',
        'custom_css',
        'custom_js',
        'custom_headers',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'no_index' => 'boolean',
        'no_follow' => 'boolean',
        'shareable' => 'boolean',
        'share_count' => 'integer',
        'structured_data' => 'array',  // JSON field for structured data
    ];
}

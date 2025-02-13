<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'user_id',
        'site_name',
        'domain_name',
        'post_back',
        'virtual_currency',
        'currency_value',
        'description',
        'status',
        'api_key',
        'secret_key',
    ];

    /**
     * Get the user associated with the Site
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

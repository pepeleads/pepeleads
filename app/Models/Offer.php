<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'campaign_id',
        'name',
        'description',
        'image_url',
        'hash_code',
        'network',
        'credit',
        'active',
        'hits',
        'limit',
        'target_url',
        'preview_url',
        'targets',
        'countries',
        'users',
        'leads',
        'date',
        'epc',
        'mobile',
        'categories',
        'web',
        'cr',
        'browser',
        'uid',
        'views',
        'convert',
        'percentage'
    ];


     /**
      * Get the rate associated with the Offer
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasOne
      */
     public function rate(): HasOne
     {
         return $this->hasOne(Network::class, 'name', 'network')->with('rate');
     }
}

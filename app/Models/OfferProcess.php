<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfferProcess extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
     'campaign_id',
     'user_id',
     'offer_id',
     'offer_name',
     'hash_code',
     'site_id',
     'api_key',
     'status',
     'start_ip',
     'end_ip',
     'credit',
     'ref_credit',
     'network',
     'link_id',
     'credit_mode',
     'source',
     'unique',
     'user_agent',
     'start_country',
     'end_country',
     'sid1',
     'sid2',
     'sid3',
     'sid4',
     'sid5',
     'date',
     'click_id',
     'unique1',
     'unique2',
     'unique3',
     'unique4'
    ];


    /**
     * Get the offer associated with the OfferProcess
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function offer(): HasOne
    {
        return $this->hasOne(Offer::class, 'campaign_id', 'campaign_id');
    }

    /**
     * Get the user associated with the OfferProcess
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'foreign_key', 'local_key');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
     'id',
     'campaign_id',
     'user_id',
     'aff_sub_1',
     'aff_sub_2',
     'aff_sub_3',
     'aff_sub_4',
     'offer_id',
     'ad_id',
     'conversion_status',
     'commission',
     'user_commission'
    ];
}

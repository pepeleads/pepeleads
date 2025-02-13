<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferwallUser extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
            'username',
            'api_key',
            'user_id',
            'gender',
            'dob_day',
            'dob_month',
            'dob_year',
            'ethnicity',
            'country',
            'state',
            'pincode',
            'merital_status',
            'education',
            'employment_status',
            'earning',
            'industry',
            'Illness'
    ];
}

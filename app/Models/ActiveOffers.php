<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveOffers extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'offer_id',
        'camp_id',
        'network',
        'user_id',
        'approved_status',
    ];

    // Define relationships if necessary
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    
    public function offers()
    {
        return $this->hasOne(Offer::class, 'id', 'offer_id')->withTrashed()->with('rate');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('approved_status', true);
    }
}

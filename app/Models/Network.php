<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Network extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'key'
    ];

    /**
     * Get the rate associated with the Network
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rate(): HasOne
    {
        return $this->hasOne(NetworkComission::class, 'network_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NetworkComission extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
      'network_id',
      'network_rate'
    ];

    /**
     * Get the network associated with the NetworkComission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function network(): HasOne
    {
        return $this->hasOne(Network::class, 'id', 'network_id');
    }
}

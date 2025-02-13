<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiProvider extends Model
{
    use HasFactory;

    protected $fillable=[
       'api_provider_name',
       'method',
       'api_endpoint',
       'status',
    ];
}

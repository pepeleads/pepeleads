<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_type',
        'role_id',
        'name',
        'companyName',
        'website',
        'city',
        'country',
        'state',
        'zipcode',
        'phone',
        'title',
        'email',
        'password',
        'question1',
        'question2',
        'question3',
        'question4',
        'question5',
        'question6',
        'question7',
        'skype',
        'linkedin',
        'profile_picture', 
        'user_type',       
        'address',         
        'refer_by',        
        'refer_id',        
        'user_id',         
        'balance',         
        'status',         
    ];


    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function assignedManager()
    {
        return $this->hasOne(User::class, 'id', 'assign_manager_id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

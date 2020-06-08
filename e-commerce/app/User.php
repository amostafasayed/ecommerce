<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'username','mobile', 'news_letter' , 'is_active', 'role', 'credit_balance', 'referral_id', 'referral_credit', 'singUp_credit'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bid(){
        return $this->has(Bid::class);
    }
    public function autoBid(){
        return $this->has(AutoBid::class);
    }
    public function contact(){
        return $this->hasOne(Contact::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('withContact', function (Builder $builder) {
            $builder->with(['contact']);
        });
    }
}

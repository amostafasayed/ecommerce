<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded=['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function promotion(){
        return $this->belongsTo(Promotion::class);
    }
    public function paymentable(){
        return $this->morphTo();
    }
}

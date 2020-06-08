<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
   protected $guarded =['id'];

    public function payments(){
        return $this->morphMany(Payment::class, 'paymentable');
    }
}

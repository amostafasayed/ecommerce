<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoBid extends Model
{
   protected $guarded=['id'];

   public function auction() {
       return $this->belongsTo(Auction::class);
   }
    public function user() {
        return $this->belongsTo(User::class);
    }
}

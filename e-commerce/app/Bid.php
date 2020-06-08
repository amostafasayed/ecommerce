<?php

namespace App;

use App\Events\BidUpdate;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $guarded=['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function auction(){
        return $this->belongsTo(Auction::class);
    }




}

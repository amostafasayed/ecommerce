<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionSlot extends Model
{
    protected $guarded = ['id'];

    public function auction()
    {
        return $this->belongsTo(AuctionSlot::class);
    }
}
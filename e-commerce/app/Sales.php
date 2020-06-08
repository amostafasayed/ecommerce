<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['total'];
    public function getTotalAttribute($value)
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += (float) $item->total_price;
        }
        return $total;
    }

   public function product () {
       return $this->belongsTo(Product::class);
   }
   public function user () {
       return $this->belongsTo(User::class);
   }
    public function items () {
        return $this->hasMany(SaleItem::class);
    }
}

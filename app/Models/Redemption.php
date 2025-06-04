<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = ['wishlist_item_id', 'redeemer_name', 'redeemer_email'];

    public function wishlistItem()
    {
        return $this->belongsTo(WishlistItem::class);
    }
}

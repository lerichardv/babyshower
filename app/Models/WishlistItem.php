<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_redeemed', 'active'];

    public function redemption()
    {
        return $this->hasOne(Redemption::class);
    }
}

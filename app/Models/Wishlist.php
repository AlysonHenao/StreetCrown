<?php

// Author: Samuel Moncada Mejía

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * WISHLIST ATTRIBUTES
 * $this->attributes['id'] - int - contains the wishlist primary key (id)
 * $this->attributes['user_id'] - int - contains the user id
 * $this->attributes['product_id'] - int - contains the product id
 * $this->attributes['created_at'] - timestamp - contains creation date
 * $this->attributes['updated_at'] - timestamp - contains update date
 * $this->user - User - contains the associated user
 * $this->product - Product - contains the associated product
 */
class Wishlist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    /**
     * Get the user that owns this wishlist entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product in this wishlist entry.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

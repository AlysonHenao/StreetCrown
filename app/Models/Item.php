<?php

// Author: Emmanuel Cortes

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ITEM ATTRIBUTES
 * $this->attributes['id'] - int - contains the item primary key (id)
 * $this->attributes['quantity'] - int - contains the item quantity
 * $this->attributes['price'] - int - contains the item price
 * $this->attributes['order_id'] - int - contains the related order id
 * $this->attributes['product_id'] - int - contains the related product id
 * $this->attributes['created_at'] - timestamp - contains item creation date
 * $this->attributes['updated_at'] - timestamp - contains item update date
 * $this->order - Order - contains the associated order
 * $this->product - Product - contains the associated product
 */
class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'product_id',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function calculateSubTotal(): int
    {
        return $this->getQuantity() * $this->getPrice();
    }

    public function validateQuantity(): bool
    {
        return $this->getQuantity() > 0;
    }
}

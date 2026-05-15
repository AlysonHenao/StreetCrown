<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Author: Your Name
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the product into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'formatted_price' => $this->getFormattedPrice(),
            'stock' => $this->getStock(),
            'image_url' => asset('storage/' . $this->getImage()),
            'product_url' => route('product.show', $this->getId()),
            'category' => [
                'id' => $this->getCategory()->getId(),
                'name' => $this->getCategory()->getName(),
            ],
        ];
    }
}

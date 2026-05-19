<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

//Author: Emmanuel Cortés
class MovieResource extends JsonResource
{
    /**
     * Transform the movie into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'director' => $this->director,
            'genre' => $this->genre,
            'views' => $this->quantity_views,
            'classification' => $this->classification,
            'description' => $this->description,
            'file_name' => $this->file_name,
        ];
    }
}

<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => __('review.rating_required'),
            'rating.min'      => __('review.rating_min'),
            'rating.max'      => __('review.rating_max'),
            'comment.min'     => __('review.comment_min'),
            'comment.max'     => __('review.comment_max'),
        ];
    }
}
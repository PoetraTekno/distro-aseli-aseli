<?php

namespace App\Http\Requests;

class UpdateProductRequest extends StoreProductRequest
{
    /**
     * Get the image validation rule for updating a product.
     */
    protected function imageRule(): string
    {
        return 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
    }
}

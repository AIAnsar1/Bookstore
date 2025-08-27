<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product): void
    {
        // Auto-generate slug from title
        if (empty($product->slug) && !empty($product->title)) {
            $product->slug = Str::slug($product->title);
        }
        
        // Set default selling method if not provided
        if (empty($product->selling_method)) {
            $product->selling_method = 'online';
        }
        
        Log::info('Product creating', ['title' => $product->title]);
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Log::info('Product created successfully', ['id' => $product->id, 'title' => $product->title]);
    }

    /**
     * Handle the Product "updating" event.
     */
    public function updating(Product $product): void
    {
        // Update slug if title changed
        if ($product->isDirty('title')) {
            $product->slug = Str::slug($product->title);
        }
        
        Log::info('Product updating', ['id' => $product->id, 'title' => $product->title]);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Log::info('Product updated', ['id' => $product->id, 'title' => $product->title]);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Log::info('Product deleted', ['id' => $product->id, 'title' => $product->title]);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        Log::info('Product restored', ['id' => $product->id, 'title' => $product->title]);
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        Log::info('Product force deleted', ['id' => $product->id, 'title' => $product->title]);
    }
}

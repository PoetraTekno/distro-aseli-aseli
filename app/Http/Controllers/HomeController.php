<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the public catalog page with optional category filtering.
     */
    public function index(Request $request): View
    {
        $activeCategory = $request->query('category');
        $categories = Category::withCount('products')->orderBy('name')->get();

        $query = Product::with('category')->latest();

        if (is_string($activeCategory) && $activeCategory !== '') {
            $query->whereHas('category', function ($categoryQuery) use ($activeCategory): void {
                $categoryQuery->where('slug', $activeCategory);
            });
        }

        $products = $query->get();

        return view('home', compact('products', 'categories', 'activeCategory'));
    }

    /**
     * Display the detail page for a single product by slug.
     */
    public function show(string $slug): View
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}

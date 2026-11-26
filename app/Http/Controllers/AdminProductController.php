<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    /**
     * Display a listing of all products in the admin panel.
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        $validated['price'] = (int) $validated['price'];
        $validated['stock'] = (int) $validated['stock'];
        $validated['image'] = $request->file('image')->store('products', 'public');

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan ke katalog.');
    }

    /**
     * Redirect single resource route to the edit form.
     */
    public function show(Product $product): RedirectResponse
    {
        return redirect()->route('admin.products.edit', $product);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = $this->generateUniqueSlug($validated['name'], $product->id);
        $validated['price'] = (int) $validated['price'];
        $validated['stock'] = (int) $validated['stock'];

        if ($request->hasFile('image')) {
            $this->deleteProductImage($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($validated['image']);
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product and its image from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteProductImage($product->image);
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus dari katalog.');
    }

    /**
     * Generate a unique URL slug for a product name.
     */
    private function generateUniqueSlug(string $name, ?int $ignoreProductId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug !== '' ? $baseSlug : 'produk';
        $counter = 2;

        while (
            Product::where('slug', $slug)
                ->when($ignoreProductId, fn ($query) => $query->where('id', '!=', $ignoreProductId))
                ->exists()
        ) {
            $slug = ($baseSlug !== '' ? $baseSlug : 'produk').'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Delete a stored product image from the public disk if present.
     */
    private function deleteProductImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}

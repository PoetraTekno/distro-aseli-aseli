<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-bold text-zinc-800 mb-1.5">
            Nama Produk <span class="text-rose-500">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               value="{{ old('name', $product->name ?? '') }}"
               placeholder='Contoh: Kaos Oversize "Aseli Lokal" Hitam'
               class="w-full rounded-xl border {{ $errors->has('name') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-200' }} px-4 py-2.5 text-sm focus:outline-none focus:ring-2">
        @error('name')
            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div>
            <label for="category_id" class="block text-sm font-bold text-zinc-800 mb-1.5">
                Kategori <span class="text-rose-500">*</span>
            </label>
            <select id="category_id"
                    name="category_id"
                    class="w-full rounded-xl border {{ $errors->has('category_id') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-200' }} bg-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-bold text-zinc-800 mb-1.5">
                Harga (Rp) <span class="text-rose-500">*</span>
            </label>
            <input type="number"
                   id="price"
                   name="price"
                   min="1000"
                   step="500"
                   value="{{ old('price', $product->price ?? '') }}"
                   placeholder="125000"
                   class="w-full rounded-xl border {{ $errors->has('price') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-200' }} px-4 py-2.5 text-sm focus:outline-none focus:ring-2">
            @error('price')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock" class="block text-sm font-bold text-zinc-800 mb-1.5">
                Stok <span class="text-rose-500">*</span>
            </label>
            <input type="number"
                   id="stock"
                   name="stock"
                   min="0"
                   value="{{ old('stock', $product->stock ?? '') }}"
                   placeholder="25"
                   class="w-full rounded-xl border {{ $errors->has('stock') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-200' }} px-4 py-2.5 text-sm focus:outline-none focus:ring-2">
            @error('stock')
                <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="description" class="block text-sm font-bold text-zinc-800 mb-1.5">
            Deskripsi Produk <span class="text-rose-500">*</span>
        </label>
        <textarea id="description"
                  name="description"
                  rows="4"
                  placeholder="Jelaskan bahan, potongan, detail sablon, dan keunggulan produk..."
                  class="w-full rounded-xl border {{ $errors->has('description') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-200' }} px-4 py-2.5 text-sm focus:outline-none focus:ring-2">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-bold text-zinc-800 mb-1.5">
            Foto Produk
            @if (! isset($product))
                <span class="text-rose-500">*</span>
            @else
                <span class="text-xs font-normal text-zinc-500">(Opsional — biarkan kosong jika tidak ingin mengganti foto)</span>
            @endif
        </label>

        @if (isset($product))
            <div class="mb-3 flex items-center gap-4 p-3 rounded-xl bg-zinc-50 border border-zinc-200">
                <div class="w-20 h-20 rounded-lg overflow-hidden bg-zinc-100 border border-zinc-200 shrink-0">
                    <x-product-image :product="$product" class="w-full h-full object-cover" />
                </div>
                <div class="text-xs text-zinc-600">
                    <p class="font-semibold text-zinc-800">Foto Saat Ini</p>
                    <p class="mt-0.5">Mengunggah foto baru akan otomatis menghapus foto lama dari penyimpanan.</p>
                </div>
            </div>
        @endif

        <input type="file"
               id="image"
               name="image"
               accept="image/jpeg,image/png,image/jpg,image/webp"
               class="block w-full text-sm text-zinc-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-zinc-900 file:text-white hover:file:bg-zinc-800 border {{ $errors->has('image') ? 'border-rose-400' : 'border-zinc-300' }} rounded-xl p-1.5 bg-white">
        <p class="mt-1.5 text-xs text-zinc-500">Format yang didukung: JPEG, PNG, JPG, WEBP. Maksimal 2 MB.</p>
        @error('image')
            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-4 border-t border-zinc-100 flex flex-wrap items-center justify-end gap-3">
        <a href="{{ route('admin.products.index') }}"
           class="px-5 py-2.5 rounded-xl border border-zinc-300 bg-white text-zinc-700 text-sm font-semibold hover:bg-zinc-50 transition">
            Batal
        </a>
        <button type="submit"
                class="px-6 py-2.5 rounded-xl bg-zinc-900 text-white text-sm font-bold hover:bg-amber-400 hover:text-zinc-950 transition shadow-sm">
            {{ $submitLabel }}
        </button>
    </div>
</div>

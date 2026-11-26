@extends('layouts.app')

@section('title', 'Panel Admin Produk — Distro Aseli Aseli')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Panel Admin</span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight mt-1">
                    Manajemen Katalog Produk
                </h1>
                <p class="text-sm text-zinc-600 mt-1">
                    Tambah, perbarui, atau hapus produk Distro Aseli Aseli.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('home') }}"
                   class="px-4 py-2.5 rounded-xl border border-zinc-300 bg-white text-zinc-700 text-sm font-semibold hover:bg-zinc-50 transition">
                    Lihat Toko
                </a>
                <a href="{{ route('admin.products.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-zinc-900 text-white text-sm font-bold hover:bg-zinc-800 transition shadow-sm">
                    + Tambah Produk
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline-flex">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl border border-rose-200 bg-rose-50 text-rose-700 text-sm font-bold hover:bg-rose-600 hover:text-white hover:border-rose-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
            @if ($products->isEmpty())
                <div class="p-12 text-center">
                    <p class="text-lg font-bold text-zinc-800">Belum ada data produk.</p>
                    <p class="text-sm text-zinc-500 mt-1">Mulai tambahkan produk pertama Anda untuk ditampilkan di katalog.</p>
                    <a href="{{ route('admin.products.create') }}"
                       class="mt-5 inline-flex items-center px-5 py-2.5 rounded-xl bg-amber-400 text-zinc-950 font-bold text-sm hover:bg-amber-300 transition">
                        + Tambah Produk
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead class="bg-zinc-50">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-zinc-500">Produk</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-zinc-500">Kategori</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-zinc-500">Harga</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-zinc-500">Stok</th>
                                <th scope="col" class="px-6 py-3.5 text-right text-xs font-bold uppercase tracking-wider text-zinc-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 bg-white">
                            @foreach ($products as $product)
                                <tr class="hover:bg-zinc-50/80 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="h-14 w-14 rounded-xl overflow-hidden bg-zinc-100 border border-zinc-200 shrink-0">
                                                <x-product-image :product="$product" class="h-full w-full object-cover" />
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-bold text-zinc-900 text-sm sm:text-base">{{ $product->name }}</p>
                                                <p class="text-xs text-zinc-400 mt-0.5 truncate max-w-xs">/produk/{{ $product->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-700">
                                            {{ $product->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-zinc-900">
                                        {{ $product->formatted_price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center rounded-md px-2.5 py-1 text-xs font-semibold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                            {{ $product->stock }} pcs
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                               class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 border border-amber-200 text-xs font-bold hover:bg-amber-100 transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk {{ addslashes($product->name) }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold hover:bg-rose-100 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

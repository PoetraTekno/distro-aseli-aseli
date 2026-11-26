@extends('layouts.app')

@section('title', 'Distro Aseli Aseli — Gaya Lokal, Kualitas Maksimal')

@section('content')
    <section class="bg-zinc-950 text-white border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-8 space-y-6">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/logo_distro_aseli_aseli.webp') }}"
                             alt="Logo Distro Aseli Aseli"
                             class="h-14 w-14 sm:h-16 sm:w-16 object-contain rounded-xl shrink-0">
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full bg-zinc-900 border border-zinc-700 px-3.5 py-1 text-xs font-semibold text-amber-400 tracking-wide uppercase mb-2">
                                <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                                Streetwear Lokal • Rilisan Terbatas
                            </div>
                            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                                Distro Aseli Aseli
                            </h1>
                        </div>
                    </div>

                    <p class="text-lg sm:text-xl font-semibold text-amber-400 italic">
                        "Gaya Lokal, Kualitas Maksimal — Aseli Buatan Anak Negeri."
                    </p>

                    <p class="text-zinc-300 text-base sm:text-lg leading-relaxed max-w-2xl">
                        Distro Aseli Aseli adalah brand pakaian streetwear dan kasual lokal yang menghadirkan desain orisinal dengan bahan katun kombed premium yang nyaman dipakai sehari-hari. Didirikan untuk mendukung industri kreatif lokal, setiap rilisan kami diproduksi secara terbatas dengan sablon berkualitas tinggi dan potongan modern.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a href="#katalog"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-400 text-zinc-950 font-bold text-sm hover:bg-amber-300 transition shadow-lg shadow-amber-400/10">
                            Jelajahi Katalog
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-zinc-900 border border-zinc-700 text-zinc-200 font-semibold text-sm hover:bg-zinc-800 hover:text-white transition">
                            Kelola Produk (Admin)
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="rounded-2xl bg-zinc-900/80 border border-zinc-800 p-6 space-y-5">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-amber-400">
                            Kenapa Distro Aseli Aseli?
                        </h2>
                        <div class="space-y-4 text-sm">
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-amber-400/15 text-amber-400 font-bold">1</span>
                                <div>
                                    <p class="font-semibold text-white">Katun Kombed Premium</p>
                                    <p class="text-zinc-400 text-xs mt-0.5">Adem, tebal, dan nyaman untuk aktivitas harian.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-amber-400/15 text-amber-400 font-bold">2</span>
                                <div>
                                    <p class="font-semibold text-white">Sablon Presisi & Awet</p>
                                    <p class="text-zinc-400 text-xs mt-0.5">Detail tajam dan tahan cuci berulang kali.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-amber-400/15 text-amber-400 font-bold">3</span>
                                <div>
                                    <p class="font-semibold text-white">100% Karya Anak Negeri</p>
                                    <p class="text-zinc-400 text-xs mt-0.5">Diproduksi terbatas mendukung kreator lokal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="katalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight">
                    Katalog Produk Terbaru
                </h2>
                <p class="text-zinc-600 text-sm mt-1">
                    Menampilkan {{ $products->count() }} produk pilihan dari koleksi Distro Aseli Aseli.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('home') }}#katalog"
                   class="px-4 py-2 rounded-full text-sm font-semibold transition {{ empty($activeCategory) ? 'bg-zinc-900 text-white shadow-sm' : 'bg-white text-zinc-700 border border-zinc-200 hover:bg-zinc-100' }}">
                    Semua
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('home', ['category' => $category->slug]) }}#katalog"
                       class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $activeCategory === $category->slug ? 'bg-zinc-900 text-white shadow-sm' : 'bg-white text-zinc-700 border border-zinc-200 hover:bg-zinc-100' }}">
                        {{ $category->name }}
                        <span class="ml-1 text-xs opacity-70">({{ $category->products_count }})</span>
                    </a>
                @endforeach
            </div>
        </div>

        @if ($products->isEmpty())
            <div class="rounded-2xl border border-dashed border-zinc-300 bg-white p-12 text-center">
                <p class="text-lg font-bold text-zinc-800">Belum ada produk pada kategori ini.</p>
                <p class="text-sm text-zinc-500 mt-1">Silakan pilih kategori lain atau tambahkan produk baru melalui Panel Admin.</p>
                <div class="mt-5 flex justify-center gap-3">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg bg-zinc-900 text-white text-sm font-semibold hover:bg-zinc-800">
                        Lihat Semua Produk
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 rounded-lg bg-amber-400 text-zinc-950 text-sm font-semibold hover:bg-amber-300">
                        + Tambah Produk
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <article class="group bg-white rounded-2xl border border-zinc-200 overflow-hidden shadow-sm hover:shadow-lg hover:border-zinc-300 transition flex flex-col">
                        <a href="{{ route('catalog.show', $product->slug) }}" class="relative aspect-square bg-zinc-100 overflow-hidden block">
                            <x-product-image :product="$product" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                            <span class="absolute top-3 left-3 inline-flex items-center rounded-full bg-zinc-950/85 backdrop-blur px-3 py-1 text-xs font-semibold text-amber-400">
                                {{ $product->category->name }}
                            </span>
                        </a>

                        <div class="p-5 flex-1 flex flex-col justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-zinc-900 leading-snug group-hover:text-zinc-700 transition">
                                    <a href="{{ route('catalog.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-zinc-500 mt-2 line-clamp-2">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-zinc-100 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-extrabold text-zinc-900">
                                        {{ $product->formatted_price }}
                                    </span>
                                    <span class="inline-flex items-center rounded-md px-2.5 py-1 text-xs font-semibold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ $product->stock > 0 ? 'Stok: '.$product->stock : 'Stok Habis' }}
                                    </span>
                                </div>

                                <a href="{{ route('catalog.show', $product->slug) }}"
                                   class="block w-full text-center px-4 py-2.5 rounded-xl bg-zinc-900 text-white text-sm font-semibold hover:bg-amber-400 hover:text-zinc-950 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection

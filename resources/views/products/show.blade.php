@extends('layouts.app')

@section('title', $product->name.' — Distro Aseli Aseli')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-6">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-600 hover:text-zinc-950 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Katalog
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-zinc-200 shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                <div class="lg:col-span-6 bg-zinc-100 aspect-square lg:aspect-auto lg:min-h-[480px]">
                    <x-product-image :product="$product" class="w-full h-full object-cover" />
                </div>

                <div class="lg:col-span-6 p-6 sm:p-10 flex flex-col justify-between gap-8">
                    <div class="space-y-5">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="inline-flex items-center rounded-full bg-zinc-900 px-3.5 py-1 text-xs font-semibold text-amber-400">
                                {{ $product->category->name }}
                            </span>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                {{ $product->stock > 0 ? 'Tersedia • Sisa Stok '.$product->stock.' pcs' : 'Stok Habis' }}
                            </span>
                        </div>

                        <h1 class="text-2xl sm:text-4xl font-extrabold text-zinc-900 tracking-tight leading-tight">
                            {{ $product->name }}
                        </h1>

                        <p class="text-3xl font-extrabold text-zinc-950">
                            {{ $product->formatted_price }}
                        </p>

                        <div class="border-t border-zinc-100 pt-5">
                            <h2 class="text-xs font-bold uppercase tracking-wider text-zinc-400 mb-2">
                                Deskripsi Produk
                            </h2>
                            <p class="text-zinc-700 leading-relaxed whitespace-pre-line">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>

                    @php
                        $whatsappText = urlencode("Halo Distro Aseli Aseli, saya tertarik memesan produk: {$product->name} ({$product->formatted_price}). Apakah stok masih tersedia?");
                    @endphp

                    <div class="pt-6 border-t border-zinc-100 flex flex-col sm:flex-row gap-3">
                        <a href="https://wa.me/6281234567890?text={{ $whatsappText }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 text-white font-bold text-sm hover:bg-emerald-500 transition shadow-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm5.81 14.04c-.24.68-1.41 1.3-1.95 1.38-.5.08-1.13.11-1.83-.11-.42-.14-.97-.32-1.67-.62-2.94-1.27-4.86-4.24-5.01-4.43-.15-.2-1.2-1.6-1.2-3.05 0-1.45.76-2.16 1.03-2.46.27-.3.59-.37.79-.37h.57c.18 0 .43-.07.67.51.24.59.84 2.04.91 2.19.07.15.12.33.02.53-.1.2-.15.33-.3.5-.15.18-.31.4-.44.53-.15.15-.3.31-.13.61.18.3.78 1.29 1.68 2.09 1.15 1.03 2.12 1.35 2.42 1.5.3.15.47.13.65-.07.18-.2.74-.86.94-1.16.2-.3.4-.25.67-.15.27.1 1.72.81 2.01.96.3.15.5.22.57.35.07.13.07.75-.17 1.43z"/>
                            </svg>
                            Pesan via WhatsApp
                        </a>

                        <a href="{{ route('home') }}"
                           class="inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-zinc-100 text-zinc-800 font-semibold text-sm hover:bg-zinc-200 transition">
                            Kembali ke Katalog
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if ($relatedProducts->isNotEmpty())
            <section class="mt-14">
                <h2 class="text-xl font-extrabold text-zinc-900 mb-6">Produk Serupa Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedProducts as $related)
                        <a href="{{ route('catalog.show', $related->slug) }}"
                           class="group bg-white rounded-2xl border border-zinc-200 overflow-hidden shadow-sm hover:shadow-md transition flex items-center gap-4 p-4">
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-zinc-100 shrink-0">
                                <x-product-image :product="$related" class="w-full h-full object-cover" />
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-amber-600">{{ $related->category->name }}</p>
                                <h3 class="text-sm font-bold text-zinc-900 truncate group-hover:underline">{{ $related->name }}</h3>
                                <p class="text-sm font-extrabold text-zinc-900 mt-1">{{ $related->formatted_price }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Produk — Panel Admin Distro Aseli Aseli')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-6">
            <a href="{{ route('admin.products.index') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-600 hover:text-zinc-950 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Produk
            </a>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 tracking-tight mt-3">
                Edit Produk: {{ $product->name }}
            </h1>
            <p class="text-sm text-zinc-600 mt-1">
                Perbarui informasi produk atau unggah foto baru jika diperlukan.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm p-6 sm:p-8">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.products._form', ['submitLabel' => 'Perbarui Produk'])
            </form>
        </div>
    </div>
@endsection

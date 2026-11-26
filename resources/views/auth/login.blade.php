@extends('layouts.app')

@section('title', 'Login Admin — Distro Aseli Aseli')

@section('content')
    <div class="min-h-[calc(100vh-14rem)] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="w-full max-w-md bg-white rounded-3xl border border-zinc-200 shadow-lg overflow-hidden">
            <div class="bg-zinc-950 px-6 py-8 text-center border-b border-zinc-800">
                <img src="{{ asset('images/logo_distro_aseli_aseli.webp') }}"
                     alt="Logo Distro Aseli Aseli"
                     class="h-20 w-20 object-contain mx-auto rounded-2xl mb-4">
                <h1 class="text-xl font-extrabold text-white tracking-tight">
                    Login Panel Admin
                </h1>
                <p class="text-xs text-zinc-400 mt-1">
                    Masuk untuk mengelola katalog produk Distro Aseli Aseli
                </p>
            </div>

            <div class="p-6 sm:p-8">
                <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="username" class="block text-sm font-bold text-zinc-800 mb-1.5">
                            Username <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               id="username"
                               name="username"
                               value="{{ old('username') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="Masukkan username admin"
                               class="w-full rounded-xl border {{ $errors->has('username') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-200' }} px-4 py-2.5 text-sm focus:outline-none focus:ring-2">
                        @error('username')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-zinc-800 mb-1.5">
                            Password <span class="text-rose-500">*</span>
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               placeholder="Masukkan password"
                               class="w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-200' : 'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-200' }} px-4 py-2.5 text-sm focus:outline-none focus:ring-2">
                        @error('password')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 text-xs text-zinc-600 cursor-pointer select-none">
                            <input type="checkbox"
                                   name="remember"
                                   value="1"
                                   class="rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900">
                            Ingat sesi saya
                        </label>
                    </div>

                    <div class="space-y-3 pt-1">
                        <button type="submit"
                                class="w-full px-5 py-3 rounded-xl bg-zinc-900 text-white font-bold text-sm hover:bg-amber-400 hover:text-zinc-950 transition shadow-sm">
                            Masuk ke Panel Admin
                        </button>

                        <a href="{{ route('home') }}"
                           class="block w-full text-center px-5 py-2.5 rounded-xl border border-zinc-300 bg-white text-zinc-700 font-semibold text-sm hover:bg-zinc-50 transition">
                            Kembali ke Halaman Utama
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

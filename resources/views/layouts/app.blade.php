<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Distro Aseli Aseli — Gaya Lokal, Kualitas Maksimal')</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/logo_distro_aseli_aseli.webp') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900 antialiased min-h-screen flex flex-col">
    <header class="sticky top-0 z-40 bg-zinc-950/95 backdrop-blur border-b border-zinc-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo_distro_aseli_aseli.webp') }}"
                         alt="Logo Distro Aseli Aseli"
                         class="h-10 w-10 sm:h-11 sm:w-11 object-contain rounded-lg shrink-0 transition group-hover:scale-105">
                    <div class="leading-tight">
                        <span class="block font-extrabold tracking-tight text-base sm:text-lg text-white">
                            Distro Aseli Aseli
                        </span>
                        <span class="hidden sm:block text-[11px] text-zinc-400 tracking-wide uppercase">
                            Local Streetwear Brand
                        </span>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-3">
                    <a href="{{ route('home') }}"
                       class="px-3.5 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') || request()->routeIs('catalog.*') ? 'bg-zinc-800 text-white' : 'text-zinc-300 hover:text-white hover:bg-zinc-900' }}">
                        Katalog Publik
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold bg-amber-400 text-zinc-950 hover:bg-amber-300 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                        Panel Admin
                    </a>

                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline-flex">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-semibold bg-zinc-800 text-rose-300 border border-zinc-700 hover:bg-rose-600 hover:text-white hover:border-rose-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    @endauth
                </nav>

                <button type="button"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                        class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-zinc-300 hover:text-white hover:bg-zinc-800 focus:outline-none"
                        aria-label="Buka menu navigasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 border-t border-zinc-800 space-y-2">
                <a href="{{ route('home') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') || request()->routeIs('catalog.*') ? 'bg-zinc-800 text-white' : 'text-zinc-300 hover:bg-zinc-900' }}">
                    Katalog Publik
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-semibold bg-amber-400 text-zinc-950 hover:bg-amber-300">
                    Panel Admin
                </a>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-3 py-2 rounded-lg text-sm font-semibold bg-zinc-800 text-rose-300 hover:bg-rose-600 hover:text-white transition">
                            Logout ({{ auth()->user()->username }})
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1">
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                <div id="flash-success" class="flex items-center justify-between gap-4 rounded-xl border border-emerald-300 bg-emerald-50 px-4 py-3.5 text-emerald-900 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                    <button type="button"
                            onclick="document.getElementById('flash-success').remove()"
                            class="text-emerald-700 hover:text-emerald-900 text-sm font-bold px-2 py-1"
                            aria-label="Tutup notifikasi">
                        &times;
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-zinc-950 text-zinc-400 border-t border-zinc-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 text-center sm:text-left">
                <img src="{{ asset('images/logo_distro_aseli_aseli.webp') }}"
                     alt="Logo Distro Aseli Aseli"
                     class="h-10 w-10 object-contain rounded-lg shrink-0">
                <div>
                    <p class="font-bold text-white">Distro Aseli Aseli</p>
                    <p class="text-xs text-zinc-400 mt-0.5">Gaya Lokal, Kualitas Maksimal — Aseli Buatan Anak Negeri.</p>
                </div>
            </div>
            <p class="text-xs text-zinc-500">
                &copy; {{ date('Y') }} Distro Aseli Aseli. UMKM Streetwear Lokal.
            </p>
        </div>
    </footer>
</body>
</html>

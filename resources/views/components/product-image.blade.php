@props([
    'product',
    'class' => 'w-full h-full object-cover',
])

@if ($product->image_url)
    <img src="{{ $product->image_url }}"
         alt="{{ $product->name }}"
         {{ $attributes->merge(['class' => $class]) }}>
@else
    <div {{ $attributes->merge(['class' => $class.' flex flex-col items-center justify-center bg-gradient-to-br from-zinc-800 to-zinc-950 text-zinc-300 p-6 text-center']) }}>
        <img src="{{ asset('images/logo_distro_aseli_aseli.webp') }}"
             alt="Logo Distro Aseli Aseli"
             class="w-16 h-16 object-contain mb-2 rounded-lg">
        <span class="text-xs font-bold tracking-widest uppercase text-amber-400">Distro Aseli Aseli</span>
        <span class="text-xs text-zinc-400 mt-1 line-clamp-1">{{ $product->name }}</span>
    </div>
@endif

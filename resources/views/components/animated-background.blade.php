@props(['variant' => 'default'])

@php
    $variants = [
        'default' => 'from-primary-700 via-primary-600 to-gold-600 opacity-90',
        'light' => 'from-primary-50 via-white to-gold-50 opacity-80',
        'rose' => 'from-rose-50 via-white to-gold-50 opacity-80',
    ];
    $gradient = $variants[$variant] ?? $variants['default'];
@endphp

<div {{ $attributes->merge(['class' => 'absolute inset-0 overflow-hidden pointer-events-none']) }}>
    <div class="absolute inset-0 bg-gradient-to-br {{ $gradient }}"></div>
    <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-white/10 blur-3xl animate-pulse"></div>
    <div class="absolute top-1/3 -right-20 w-80 h-80 rounded-full bg-gold-300/20 blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-28 left-1/4 w-96 h-96 rounded-full bg-primary-300/20 blur-3xl animate-pulse"></div>
</div>

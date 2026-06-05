@props([
    'position' => 'top',
    'color' => 'white',
])

@php
    $fill = [
        'white' => '#ffffff',
        'gray' => '#f9fafb',
        'gold' => '#f8e7b0',
    ][$color] ?? '#ffffff';
    $positionClass = $position === 'bottom' ? 'bottom-0 rotate-180' : 'top-0';
@endphp

<div {{ $attributes->merge(['class' => "absolute left-0 right-0 {$positionClass} pointer-events-none z-0"]) }}>
    <svg viewBox="0 0 1440 90" preserveAspectRatio="none" class="block w-full h-12" aria-hidden="true">
        <path fill="{{ $fill }}" d="M0,48 C180,90 360,10 540,42 C720,74 900,84 1080,44 C1260,4 1350,18 1440,36 L1440,0 L0,0 Z"></path>
    </svg>
</div>

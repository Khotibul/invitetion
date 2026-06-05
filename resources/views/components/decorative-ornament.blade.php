@props([
    'position' => 'top-left',
    'type' => 'floral',
    'color' => 'primary',
])

@php
    $positions = [
        'top-left' => 'top-6 left-6',
        'top-right' => 'top-6 right-6',
        'bottom-left' => 'bottom-6 left-6',
        'bottom-right' => 'bottom-6 right-6',
    ];
    $colors = [
        'primary' => 'text-primary-300/40',
        'gold' => 'text-gold-400/45',
    ];
    $classes = ($positions[$position] ?? $positions['top-left']).' '.($colors[$color] ?? $colors['primary']);
@endphp

<div {{ $attributes->merge(['class' => "absolute {$classes} pointer-events-none z-0"]) }}>
    @if($type === 'hearts')
        <svg class="w-24 h-24" viewBox="0 0 120 120" fill="currentColor" aria-hidden="true">
            <path d="M36 44c0-10 8-18 18-18 6 0 11 3 14 8 3-5 8-8 14-8 10 0 18 8 18 18 0 22-32 40-32 40S36 66 36 44Z" opacity=".65"/>
            <path d="M18 78c0-6 5-11 11-11 4 0 7 2 9 5 2-3 5-5 9-5 6 0 11 5 11 11 0 13-20 25-20 25S18 91 18 78Z" opacity=".35"/>
        </svg>
    @elseif($type === 'geometric')
        <svg class="w-28 h-28" viewBox="0 0 120 120" fill="none" stroke="currentColor" aria-hidden="true">
            <circle cx="60" cy="60" r="38" stroke-width="2" opacity=".55"/>
            <path d="M60 18l36 42-36 42-36-42 36-42Z" stroke-width="2" opacity=".45"/>
            <circle cx="60" cy="60" r="8" fill="currentColor" opacity=".35"/>
        </svg>
    @else
        <svg class="w-28 h-28" viewBox="0 0 120 120" fill="currentColor" aria-hidden="true">
            <path d="M63 21c15 18 11 35-2 47-13-12-17-29 2-47Z" opacity=".5"/>
            <path d="M58 69c-22 1-36-10-40-31 22 1 36 12 40 31Z" opacity=".35"/>
            <path d="M65 70c20-7 36-1 47 17-21 7-37 1-47-17Z" opacity=".35"/>
            <path d="M60 67c-3 14-8 25-18 34" stroke="currentColor" stroke-width="4" fill="none" opacity=".4"/>
        </svg>
    @endif
</div>

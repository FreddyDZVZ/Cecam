@props([
    'href' => '#',
    'active' => false,
])

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition ' .
        ($active
            ? 'bg-white text-[#14533f] shadow-md'
            : 'text-white/85 hover:bg-white/10 hover:text-white')
    ]) }}
>
    {{ $slot }}
</a>

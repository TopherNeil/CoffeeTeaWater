@props(['name', 'severity' => 'custom'])

@switch($severity)
    @case('primary')
        <a {{ $attributes->merge(['class' => 'bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg']) }}>
            {{ $name }}
        </a>
        @break
    @case('secondary')
        <a {{ $attributes->merge(['class' => 'bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg']) }}>
            {{ $name }}
        </a>
        @break
    @default
        <a {{ $attributes->merge(['class' => 'px-4 py-2 rounded-lg']) }}>
            {{ $name }}
        </a>
@endswitch

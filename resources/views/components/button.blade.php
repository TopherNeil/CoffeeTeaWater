@props(['name', 'severity' => 'custom'])

@switch($severity)
    @case('primary')
        <button {{ $attributes->merge(['class' => 'bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg']) }}>
            {{ $name }}
        </button>
        @break
    @case('secondary')
        <button {{ $attributes->merge(['class' => 'bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg']) }}>
            {{ $name }}
        </button>
        @break
    @case('danger')
        <button {{ $attributes->merge(['class' => 'bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg']) }}>
            {{ $name }}
        </button>
        @break
    @default
        <button {{ $attributes->merge(['class' => 'px-4 py-2 rounded-lg']) }}>
            {{ $name }}
        </button>
@endswitch

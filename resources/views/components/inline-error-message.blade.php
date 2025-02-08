@props(['element'])

@error($element)
    <p class="text-sm text-red-400">{{ $message }}</p>
@enderror

@props(['message', 'route', 'button_name', 'text_class', 'link_btn_class'])

@if($message)
    <div {{$attributes->merge(['class' => 'relative rounded-md px-4 py-2'])}}>
        <p class="{{ $text_class }}">{{ $message }}</p>
        <x-link-button class="{{ $link_btn_class }}" name="{{ $button_name }}" href="{{ $route }}"/>
    </div>
@endIf
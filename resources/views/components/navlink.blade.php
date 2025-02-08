@props(['icon', 'url' => '#', 'active', 'isPlus' => false])

<a href="{{ $url }}">
    <div
        class="rounded-lg flex justify-center items-center w-[50px] h-[50px] hover:bg-slate-100 {{ $isPlus ? 'bg-slate-200 hover:bg-slate-300' : '' }} ">
        <x-dynamic-component :component="$icon"
            class="{{ $active ? 'text-black' : 'text-slate-400' }} w-[25px] h-[25px]" />
    </div>
</a>

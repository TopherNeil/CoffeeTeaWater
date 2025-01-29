@props(['icon', 'active' => false, 'type' => 'submit', 'active_state' => '', 'inactive_state' => '', 'text' => null])


<button {{$attributes->merge(["class" => "group flex gap-2 shadow-md rounded-lg border border-slate-200 items-center px-4 py-2"])}}>
    <x-dynamic-component :component="$icon" class="{{ $active ? $active_state : $inactive_state }} w-[25px] h-[25px]" />
    <span class="{{ $active ? $active_state : $inactive_state }} font-bold">{{ ucfirst($text) }}</span>
</button>


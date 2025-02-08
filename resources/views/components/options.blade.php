<div class="relative" x-data="{ open: false, loginUrl: '{{ route('login') }}' }">
    <div role="button" class="rounded p-2 hover:bg-slate-200 flex items-center" x-transition
        @click="{{ Auth::check() ? 'open = !open' : 'window.location.href = loginUrl' }}">
        <x-fas-ellipsis class="text-slate-400 w-[25px] h-[25px]"></x-fas-ellipsis>
    </div>
    <div class="rounded p-2 divide-y absolute flex flex-col -bottom-15 -right-60 bg-slate-50 shadow-md text-center w-[250px] h-[auto] border border-slate-200"
        x-show="open" @click.outside="open = false">
        {{ $slot }}
    </div>
</div>

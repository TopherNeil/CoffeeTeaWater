<nav {{ $attributes->merge([ 'class' => 'z-10 h-[100vh] w-[80px] py-5 bg-white flex flex-col justify-between items-center fixed left-0 shadow-md']) }}>
    <div role="button" class="w-[75px] h-[50px] flex items-center justify-center">
        <a href="/" class="text-xl hover:scale-125 transition ease-in-out delay-250 duration-300 font-bold ">{{ __('CTW') }}</a>
    </div>

    <div class="relative w-auto h-auto">
        <div class="flex flex-col gap-6">
            <x-navlink icon="fas-home" url="/home" :active="request()->is('home') || request()->is('/')"/>
            <x-navlink icon="fas-search" url="/search" :active="request()->is('search')"/>
            <x-navlink icon="fas-plus" url="/post" :active="request()->is('post')" :isPlus="true"/>
            <x-navlink icon="fas-heart" url="/notification" :active="request()->is('notification')"/>
            <x-navlink icon="fas-user" url="/profile" :active="request()->is('profile')"/>
        </div>
    </div>
    
    <x-dropdown>
        <a class="rounded hover:bg-slate-200 hover:shadow-sm" href="/settings">{{ __('Settings') }}</a>
        <form class="w-full" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class=" w-full rounded hover:bg-slate-200 hover:shadow-sm">{{ __('Sign Out') }}</button>
        </form>
    </x-dropdown>
</nav>

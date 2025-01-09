<nav class="fixed top-10 right-10">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Dashboard
        </a>
    @else
        <x-button
            href="{{ route('login') }}"
            outline
            secondary
            label="Login"
            class="m-2 text-black bg-slate-200 hover:text-white hover:bg-slate-700"
        />
            

        @if (Route::has('register'))
            <x-button
                href="{{ route('register') }}"
                flat
                secondary
                label="Register"
                class="m-2 text-black bg-slate-200 hover:text-white hover:bg-slate-700"
            />
        @endif
    @endauth
</nav>

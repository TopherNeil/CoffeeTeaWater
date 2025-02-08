<x-layout :title="'Error'" class="flex flex-col justify-center items-center min-h-screen w-full bg-slate-300">
    <p class="text-[40px] font-bold ">{{ __('404 Page Not Found!') }}</p>
    <x-link-button severity="secondary" name="Go back" href="/" />
</x-layout>

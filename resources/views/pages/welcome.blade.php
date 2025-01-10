<x-layouts-app>
    <x-navbar>
        <img src="{{ asset('assets/images/icon_coffee_tea_water.png') }}" class="max-sm:w-[100px] max-sm:h-[100px] max-md:w-[120px] max-md:h-[120px] w-[150px] h-[150px]">
        <div class="flex gap-2">
            <x-link-button href="/login" role="button" severity="secondary" name="Login" />   
            <x-link-button href="/register" role="button" severity="secondary" name="Register" />   
        </div>
    </x-navbar>
    <div class="flex flex-col justify-around items-center">
        <img src="{{ asset('assets/images/coffee_tea_water.png') }}">
        <div class="flex justify-center items-center gap-4">
            <span class="text-slate-600"><span class="font-bold text-[32px]">Capture</span> every sip.</span>
            <span class="text-slate-600"><span class="font-bold text-[32px]">Spill</span> your story.</span>
            <span class="text-slate-600"><span class="font-bold text-[32px]">Cheers</span> to memories.</span>
        </div>
    </div>
</x-layouts-app>
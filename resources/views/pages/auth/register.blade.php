<x-layout :title="'Register'" class="flex flex-col items-center mx-2">
    <a href="/"><img src="{{ asset('assets/images/icon_coffee_tea_water.png') }}" class="w-[150px] h-[150px]"></a>
    <x-card class="bg-slate-100 w-[550px] h-auto min-h-[570px] flex justify-center items-center py-5">

        <x-message button_name="x" route="/clear-session" 
                message="{{ Session::get('message') }}" 
                class="bg-red-300 w-[360px] p-[10px]"
                text_class="text-red-600 text-center" 
                link_btn_class="absolute -top-1 right-0 text-xl text-red-700 hover:text-red-800"
        />

        <form class="w-full px-12" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="flex flex-col gap-8 justify-center items-center">
                <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                    <label for="username" class="text-sm w-full">Username:</label>
                    <input type="text" name="username" class="outline outline-1 rounded shadow-sm w-full h-[40px] px-2" value="{{old('username')}}">            
                    <x-inline-error-message element="username" />
                </div>
                <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                    <label for="email" class="text-sm w-full">Email:</label>
                    <input type="email" name="email" class="outline outline-1 rounded shadow-sm w-full h-[40px] px-2" value="{{old('email')}}">            
                    <x-inline-error-message element="email" />
                </div>
                <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                    <label for="password" class="text-sm w-full">Password:</label>
                    <input type="password" name="password" class="outline outline-1 rounded shadow-sm w-full h-[40px] px-2">            
                    <x-inline-error-message element="password" />
                </div>
                <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                    <label for="password_confirmation" class="text-sm w-full">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="outline outline-1 rounded shadow-sm w-full h-[40px] px-2">            
                    <x-inline-error-message element="password" />
                </div>
                <div class="flex flex-col items-center">
                    <x-button type="submit" severity="secondary" name="Register" class="w-[100px] h-[50px]"/>
                    <x-link-button href="/login" name="Already have an account?"></x-link-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
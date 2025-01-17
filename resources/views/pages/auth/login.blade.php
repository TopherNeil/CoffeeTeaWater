<x-layout :title="'Login'" class="flex flex-col items-center mx-2">
    <a href="/"><img src="{{ asset('assets/images/icon_coffee_tea_water.png') }}" class="w-[150px] h-[150px]"></a>
    <x-card class="bg-slate-100 w-[450px] h-[450px] flex flex-col justify-center items-center">

        <x-message button_name="x" route="/clear-session" 
                    message="{{ Session::get('message') }}" 
                    class="bg-red-300 w-[360px] p-[10px] my-2"
                    text_class="text-red-600 text-center" 
                    link_btn_class="absolute -top-1 right-0 text-xl text-red-700 hover:text-red-800"
                    />
                    
        <form class="w-full px-12" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col gap-8 justify-center items-center">
                <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                    <label for="login" class="text-sm w-full">Username or Email</label>
                    <input type="text" name="login" class="outline outline-1 rounded w-full h-[40px] px-2" value="{{old('login')}}"/>
                    <x-inline-error-message element="login" />
                </div>
                <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                    <label for="password" class="text-sm w-full">Password</label>
                    <input type="password" name="password" class="outline outline-1 rounded w-full h-[40px] px-2"/>
                    <x-inline-error-message element="password" />            
                </div>
                <div class="flex flex-col items-center gap-2">
                    <x-button type="submit" severity="secondary" name="Login" class="w-[100px] h-[50px]"/>
                    <x-link-button href="/register" name="Create an account?"></x-link-button> 
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
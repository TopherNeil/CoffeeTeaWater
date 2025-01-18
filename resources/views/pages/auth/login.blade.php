<x-layout :title="'Login'" class="flex flex-col items-center mx-2">  
    <div class="w-full h-screen flex items-center">
        <x-card class="bg-gradient-to-b from-slate-300 to-slate-100 w-[450px] h-[450px] flex flex-col justify-center items-center relative">
                <img class="-top-[340px] absolute" src="{{ asset('assets/images/coffee_tea_water.png') }}" alt="">
                <div class="flex justify-center w-full -right-3 -top-[50px] absolute">
                    <span class="text-2xl text-white font-bold">C</span>
                    <span class="text-2xl text-white font-bold">T</span>
                    <span class="text-2xl text-white font-bold">W</span>
                </div>

            <x-message button_name="x" route="/clear-session" 
                        message="{{ Session::get('message') }}" 
                        class="bg-red-300 w-[360px] p-[20px] my-5"
                        text_class="text-red-600 text-center" 
                        link_btn_class="absolute -top-1 right-0 text-xl text-red-700 hover:text-red-800"
                        />
                        
            <form class="w-full px-12" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex flex-col gap-8 justify-center items-center">
                    <div class="w-full h-full flex flex-col justify-center items-start">
                        <x-inline-error-message element="login" />
                        <input type="text" name="login" class="rounded-lg w-full h-[60px] focus:outline-none shadow-md px-5 py-2" value="{{old('login')}}" placeholder="Username or Email"/>
                        
                    </div>
                    <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                        <x-inline-error-message element="password" />            
                        <input type="password" name="password" class="rounded-lg w-full h-[60px] focus:outline-none shadow-md px-5 py-2" value="{{old('password')}}" placeholder="Password"/>
                    </div>
                    <div class="flex flex-col items-center gap-2 w-full">
                        <x-button type="submit" name="Login" class="bg-black hover:bg-slate-800 text-white w-full h-[60px] rounded-lg shadow-lg font-bold"/>
                        <x-link-button href="/register" name="Create an account?"/>
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
<x-layout :title="'Register'" class="flex flex-col items-center mx-2">
    <div class="w-full h-screen flex items-center">
        <x-card class="bg-gradient-to-b from-slate-300 to-slate-100 w-[570px] h-[650px] flex flex-col justify-center items-center relative">
                <img class="-top-[300px] h-[400px] absolute" src="{{ asset('assets/images/coffee_tea_water.png') }}" alt="">
                <div class="flex justify-center w-full -right-2 -top-[50px] absolute">
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
                        
            <form class="w-full px-12 py-10" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="flex flex-col gap-8 justify-center items-center">
                    <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                        <x-inline-error-message element="username" />
                        <input type="text" name="username" class="rounded-lg w-full h-[60px] focus:outline-none shadow-md px-5 py-2" value="{{old('username')}}" placeholder="Username">            
                    </div>
                    <div class="w-full h-full flex flex-col justify-center items-start">
                        <x-inline-error-message element="email" />
                        <input type="text" name="email" class="rounded-lg w-full h-[60px] focus:outline-none shadow-md px-5 py-2" value="{{old('email')}}" placeholder="Email"/>
                        
                    </div>
                    <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                        <x-inline-error-message element="password" />            
                        <input type="password" name="password" class="rounded-lg w-full h-[60px] focus:outline-none shadow-md px-5 py-2" placeholder="Password"/>
                    </div>
                    <div class="w-full h-full flex flex-col gap-2 justify-center items-start">
                        <x-inline-error-message element="password" />            
                        <input type="password" name="password_confirmation" class="rounded-lg w-full h-[60px] focus:outline-none shadow-md px-5 py-2" placeholder="Confirm Password"/>
                    </div>
                    <div class="flex flex-col items-center gap-2 w-full">
                        <x-button type="submit" name="Register" class="bg-black hover:bg-slate-800 text-white w-full h-[60px] rounded-lg shadow-lg font-bold"/>
                        <x-link-button href="/login" name="Already have an account?"/>
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
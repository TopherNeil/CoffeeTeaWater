<x-layout>
    <x-navbar>
        
    </x-navbar>
    <x-card class="mt-4 h-auto w-[600px] flex flex-col justify-start items-center">
        <div class="mt-4">
            <a href="{{ route('profile.edit') }}">
                <div class="group relative rounded-full h-[120px] w-[120px] flex justify-center items-center">
                    <!-- Profile Picture -->
                    <img 
                        class="rounded-full h-full w-full object-cover" 
                        src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('assets/images/blank_profile.png') }}" 
                        alt="User Profile Picture"
                    />
                    
                    <!-- Hover Edit Text -->
                    <span class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center text-white text-sm font-semibold rounded-full opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        Edit
                    </span>
                </div>
            </a>
            <span class="text-center font-bold mt-2">{{ 'u/' . $user->username }}</span>
        </div>

        <div class="mt-10 px-6 w-[600px] my-5">

            @foreach ($posts as $post)
                <div class="mt-6 pt-4 flex flex-col items-center">
                    <div class="flex flex-col border-t border-slate-300 my-2 p-5 w-100 h-auto rounded relative">
                        <div class="flex w-full gap-2 justify-between items-center">
                            <div class="flex items-center gap-2">
                                <h1 class="text-xl font-bold hover:text-gray-600">{{ 'u/' . $post->username }}</h1>
                                <span class="text-xs">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <div>
                                <x-options>
                                    <a class="rounded hover:bg-slate-200 hover:shadow-sm" href="/post/edit/{{$post->post_id}}">{{ __('Edit') }}</a>
                                    <form method="POST" class="w-full" action="/post/delete/{{$post->post_id}}">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="rounded w-full hover:bg-slate-200 hover:shadow-sm hover:text-red-600">{{__('Delete')}}</button>
                                    </form>
                                </x-options>
                            </div>  
                        </div>
                    
                    <a class="hover:text-slate-600 self-start" href="/post/{{$post->post_id}}"><span class="font-bold text-2xl self-start">{{$post->title}}</span></a>
                    <a class="w-[500px] h-[400px] bg-slate-700 rounded" href="storage/{{$post->photo}}">
                        <img class="mx-auto rounded-lg w-[500px] h-[400px]" src="{{Storage::url($post->photo)}}" alt="">
                    </a>
                </div>
                
                
            @endforeach

        </div>
        
        
    </x-card>
    
    
</x-layout>
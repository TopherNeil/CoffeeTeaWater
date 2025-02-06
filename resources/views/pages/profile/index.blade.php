<x-layout>
    <x-navbar/>
        
    <div class="w-full flex justify-center mt-[20px] h-[20px]">
        <span class="text-xl font-bold">{{__('Profile')}}</span>
    </div>
    <div class="w-[830px] h-auto flex flex-col rounded shadow-lg border-slate-600 p-10">
        <div class="mt-4 w-full flex flex-col items-center justify-center">
            <a href="{{ route('profile.edit') }}">
                <div class="group relative rounded-full h-[120px] w-[120px] flex justify-center items-center">
                    <!-- Profile Picture -->
                    <img 
                        class="rounded-full h-full w-full object-cover" 
                        src="{{ $user->profile_picture ? Storage::url($user->profile_picture) : asset('assets/images/blank_profile.png') }}" 
                        alt="User Profile Picture"
                    />
                    <span class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center text-white text-sm font-semibold rounded-full opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        Edit
                    </span>
                </div>
            </a>
            <span class="text-center font-bold mt-2">{{ 'u/' . $user->username }}</span>
        </div>
        @foreach ($posts as $post)
            <div id="{{$post->post_id}}" class="flex flex-col border-t border-slate-300 my-2 p-5 w-100 h-auto rounded relative">
                <div class="flex w-full gap-2 justify-between items-center">
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl font-bold hover:text-gray-600">{{ 'u/' . $post->username }}</h1>
                        <span class="text-xs">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    @auth
                        @if(Auth::user()->id === $post->user_id)
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
                        @endif
                    @endauth
                </div>
                
                <div class="hover:text-gray-600 my-2">
                    <a href="/post/{{$post->post_id}}" class="text-3xl font-bold">{{$post->title}}</a>
                </div>

                @if($post->photo)
                    <a href="/storage/{{ $post->photo }}" class="cursor-zoom-in">
                        <div class="bg-gradient-to-tr from-slate-600 to-slate-800 w-full h-[450px] rounded flex justify-center">
                            <img class="rounded h-full" src="{{ Storage::url($post->photo) }}" alt="">
                        </div>
                    </a>
                @else
                    <div class="mt-2">
                        <p class="text-xl">{{ $post->description }}</p>
                    </div>
                @endif
                <div class="mt-6 flex w-full gap-2">
                    <livewire:like :post_id="$post->post_id" /> 
                    
                    <a class="group" href="/post/{{$post->post_id}}">
                        <x-button severity="custom" name="Comments({{$post->comment_count}})" active_state="text-orange-600 group-hover:text-orange-300" inactive_state="text-gray-600 group-hover:text-orange-600" class=""/>
                    </a>
                </div>
            </div>   
        @endforeach
    </div>
</x-layout>
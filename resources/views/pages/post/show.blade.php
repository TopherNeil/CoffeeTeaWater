<x-layout>
    <x-navbar/>
    <div class="w-[830px] h-auto flex flex-col rounded shadow-lg border-slate-600 p-10">
        <div class="flex flex-col border-t border-slate-300 my-2 p-5 w-100 h-auto rounded relative">
            <div class="flex w-full gap-2 justify-between items-center">
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-bold hover:text-gray-600">{{ 'u/' . $post->username }}</h1>
                    <span class="text-xs">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                @auth
                    @if(Auth::user()->id === $post->user_id)
                    <div>
                        <x-options>
                            <a class="rounded hover:bg-slate-200 hover:shadow-sm" href="/post/edit/{{$post->id}}">{{ __('Edit') }}</a>
                            <form method="POST" class="w-full" action="/post/delete/{{$post->id}}">
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
                <a href="/post/{{$post->id}}" class="text-3xl font-bold">{{$post->title}}</a>
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
                <form method="POST" action="{{ route('home') }}">
                    @csrf
                     <x-icon-button icon="fas-thumbs-up" text="like" active_state="text-blue-600 group-hover:text-blue-300" inactive_state="text-gray-600 group-hover:text-blue-600"/>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-icon-button icon="fas-comment" text="comment" active_state="text-orange-600 group-hover:text-orange-300" inactive_state="text-gray-600 group-hover:text-orange-600"/>
                </form>
            </div>
        </div>  
    </div>
</x-layout>
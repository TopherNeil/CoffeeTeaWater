@guest
    <div class="z-10 flex gap-2 fixed top-5 right-10">
        <x-link-button href="/login" role="button" name="Login" class="rounded-lg bg-slate-900 text-white font-semibold" />   
    </div>
@endguest

<x-layout>
    <x-navbar/>        
    <div class="w-full flex justify-center mt-[20px] h-[20px]">
        <span class="text-xl font-bold">{{__('Home')}}</span>
    </div>
    <div class="w-[830px] h-auto flex flex-col rounded shadow-lg border-slate-600 p-10">
        
        @foreach ($posts as $post)
            <div id="{{$post->id}}" class="flex flex-col border-t border-slate-300 my-2 p-5 w-100 h-auto rounded relative">
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
                    @if(!in_array(Auth::id(), $post->likers)) 
                        <form method="POST" action="{{ route('like.store', ['post_id' => $post->id]) }}">
                            @csrf
                            <x-icon-button icon="fas-heart" text="{{$post->likes_count}}" active_state="text-red-600 group-hover:text-red-300" inactive_state="text-gray-600 group-hover:text-red-600"/>
                        </form>
                    @else
                        <form method="POST" action="{{ route('like.destroy', ['post_id' => $post->id]) }}">
                            @csrf
                            @method('DELETE')
                            <x-icon-button icon="fas-heart" :active="true" text="{{$post->likes_count}}" active_state="text-red-600 group-hover:text-red-300" inactive_state="text-gray-600 group-hover:text-red-600"/>
                        </form>
                    @endif
                
                    <a class="group" href="/post/{{$post->id}}">
                        <x-button severity="custom" name="Comments({{$post->comments_count}})" active_state="text-orange-600 group-hover:text-orange-300" inactive_state="text-gray-600 group-hover:text-orange-600"/>
                    </a>
                </div>
            </div>   
        @endforeach
    </div>
</x-layout>

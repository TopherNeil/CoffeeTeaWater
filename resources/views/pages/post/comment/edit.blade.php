<x-layout>
    <x-navbar/>
    <div class="w-[830px] h-auto flex flex-col rounded-lg shadow-lg p-10">
        <div class="flex flex-col mb-2 p-5 w-100 h-auto rounded relative">
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
                <div class="mb-2">
                    <p class="text-xl">{{ $post->description }}</p>
                </div>
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
                    <x-icon-button icon="fas-heart" :active="true" text="143" active_state="text-red-600 group-hover:text-red-300" inactive_state="text-gray-600 group-hover:text-red-600"/>
                </form>
            </div>
        </div>
        <div class="rounded-lg w-full h-auto px-5 py-2">
            
            <form class="flex flex-col gap-2" method="POST" action="{{ route('comment.update', ['post_id' => $post->id, 'comment_id' => $comment['id']] )}}">
                @csrf
                @method('PUT')
                <div class="flex items-center gap-2">
                    <div class="rounded-[50%] bg-slate-300 h-[50px] w-[50px]">
                        <img class="rounded-[50%] object-contain h-[50px] w-[50px] " src="{{Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('assets/images/blank_profile.png')}}" alt="profile_picture"/>
                    </div>
                    <div class="w-full flex flex-col">
                        <span class="text-xs text-blue-400">Editing...</span>
                        <textarea class="focus:outline-none border-b border-gray-200 h-[50px] min-h-[50px] rounded-lg p-2 w-full shadow" name="content" rows="5" placeholder="Write a comment...">{{old('content', $comment['content'])}}</textarea>
                    </div>
                </div>
                
                <x-button severity="custom" type="submit" name="Finish" class="self-end hover:text-orange-600"/>
            </form>
        </div>  
    </div>
</x-layout>
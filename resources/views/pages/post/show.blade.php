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
        <div class="border-2 border-slate-100 rounded-lg w-full h-auto px-5 py-5">
            
            <form class="flex flex-col gap-2" method="POST" action="{{ route('home') }}">
                <textarea class="border focus:outline-none border-gray-200 h-[100px] min-h-[100px] rounded-lg p-2 w-full shadow" name="comment" rows="5" placeholder="Write a comment..."></textarea>
                <x-icon-button class="self-end w-[100px] text-center" icon="fas-up-long" text="Send" active_state="text-orange-600 group-hover:text-orange-300" inactive_state="text-gray-600 group-hover:text-orange-600"/>
            </form>

            <span class="mb-5">{{ 'Comments(' . count($comments) . ')' }}</span>
            <div class="flex flex-col gap-2">
                @if (count($comments) > 0)
                    @foreach ($comments as $comment)
                        <div class="w-full flex flex-col rounded-lg shadow p-4">
                            <span class="font-bold">{{$comment["commenter_name"]}}</span>
                            <span class="text-sm">{{$comment["comment"]}}</span>
                        </div>
                    @endforeach
                    @if ($comments->hasPages())
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                    @endif
                @else
                    <div class="w-full h-[100px] flex flex-col items-center justify-center">
                        <span class="text-xl">No Comments Yet.</span>
                        <span class="font-bold">:<</span>
                    </div>
                @endif
            </div>
        </div>  
    </div>
</x-layout>
<x-layout>
    <x-navbar />
    <div class="w-[830px] h-auto flex flex-col rounded-lg shadow-lg p-10">
        <div class="flex flex-col mb-2 p-5 w-100 h-auto rounded relative">
            <div class="flex w-full gap-2 justify-between items-center">
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-bold hover:text-gray-600">{{ 'u/' . $post->username }}</h1>
                    <span class="text-xs">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                @auth
                    @if (Auth::user()->id === $post->user_id)
                        <div>
                            <x-options>
                                <a class="rounded hover:bg-slate-200 hover:shadow-sm"
                                    href="/post/edit/{{ $post->id }}">{{ __('Edit') }}</a>
                                <form method="POST" class="w-full" action="/post/delete/{{ $post->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded w-full hover:bg-slate-200 hover:shadow-sm hover:text-red-600">{{ __('Delete') }}</button>
                                </form>
                            </x-options>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="hover:text-gray-600 my-2">
                <a href="/post/{{ $post->id }}" class="text-3xl font-bold">{{ $post->title }}</a>
            </div>

            @if ($post->photo)
                <div class="mb-2">
                    <p class="text-xl break-all">{{ $post->description }}</p>
                </div>
                <a href="/storage/{{ $post->photo }}" class="cursor-zoom-in">
                    <div
                        class="bg-gradient-to-tr from-slate-600 to-slate-800 w-full h-[450px] rounded flex justify-center">
                        <img class="rounded h-full" src="{{ Storage::url($post->photo) }}" alt="">
                    </div>
                </a>
            @else
                <div class="mt-2">
                    <p class="text-xl break-all">{{ $post->description }}</p>
                </div>
            @endif
            <div class="mt-6 flex w-full gap-2">
                <livewire:like :post_id="$post->id" />
            </div>
        </div>
        <div class="rounded-lg w-full h-auto px-5 py-2">

            <form class="flex flex-col gap-2" method="POST"
                action="{{ route('comment.store', ['post_id' => $post->id]) }}">
                @csrf
                <div class="flex items-center gap-2">
                    <div class="rounded-[50%] bg-slate-300 h-[50px] w-[50px]">
                        <img class="rounded-[50%] object-contain h-[50px] w-[50px] "
                            src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('assets/images/blank_profile.png') }}"
                            alt="profile_picture" />
                    </div>
                    <textarea class="focus:outline-none border-b border-gray-200 h-[50px] min-h-[50px] rounded-lg p-2 w-full shadow"
                        name="content" rows="5" placeholder="Write a comment..."></textarea>
                </div>

                <x-button severity="custom" type="submit" name="Comment" class="self-end hover:text-orange-600" />
            </form>

            <span class="mb-5">{{ 'Comments(' . $comments->total() . ')' }}</span>
            <div class="flex flex-col justify-center gap-2">
                @if (count($comments) > 0)
                    @foreach ($comments as $comment)
                        <div class="w-full flex items-center rounded-lg gap-2 shadow p-4">
                            <div class="rounded-[50%] bg-slate-300 h-[50px] w-[50px]">
                                <img class="rounded-[50%] object-contain h-[50px] w-[50px] "
                                    src="{{ $comment->profile_picture ? Storage::url($comment->profile_picture) : asset('assets/images/blank_profile.png') }}"
                                    alt="profile_picture" />
                            </div>
                            <div class="flex flex-col justify-center w-full">
                                <div class="flex gap-2 items-center">
                                    <span class="font-bold">{{ 'u/' . $comment->username }}</span>
                                    <span class="text-xs">{{ $comment->updated_at->diffForHumans() }}</span>
                                    @if ($comment->created_at != $comment->updated_at)
                                        <span class="text-xs text-blue-400">Edited</span>
                                    @endif
                                </div>

                                <p class="text-sm w-full break-all">{{ $comment->content }}</p>
                            </div>
                            @if (Auth::id() == $comment->user_id)
                                <div>
                                    <x-options>
                                        <a href="/comment/edit/{{ $post->id }}/{{ $comment->id }}"
                                            class="hover:text-blue-400">Edit</a>
                                        <form method="POST"
                                            action="{{ route('comment.destroy', ['comment_id' => $comment->id]) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button role="button" type="submit"
                                                class="hover:text-red-600">Delete</button>
                                        </form>
                                    </x-options>

                                </div>
                            @endif
                        </div>
                    @endforeach
                    @if ($comments->hasPages())
                        <div class="mt-4">
                            {{ $comments->links() }}
                        </div>
                    @endif
                @else
                    <div class="w-full h-[200px] flex flex-col items-center justify-center">
                        <img class="ms-10 w-[200px] h-[200px]" src="{{ asset('assets/images/no_comment_gif.gif') }}"
                            alt="">
                        <span class="text-xl font-thin">{{ __('No Comments Yet.') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>

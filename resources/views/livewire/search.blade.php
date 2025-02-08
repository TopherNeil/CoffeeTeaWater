<div class="w-full">
    <input class="border border-slate-100 shadow-md p-2 w-full h-[50px] rounded focus:outline-none" wire:model="search" wire:keydown="researchUser" placeholder="Search...">
    @if($search != '') 
        @foreach ($users as $user)
            <a href="/profile/{{'@'.$user->username}}">
                <div class="flex gap-2 my-2 items-center border rounded border-blue-300 p-3 shadow-blue-300 shadow-sm">
                    <img class="w-[50px] h-[50px] object-fill rounded-[50%] border border-blue-400" src="{{$user->profile_picture ? Storage::url($user->profile_picture) : asset('assets/images/blank_profile.png')}}" alt="">
                    <span>{{'u/'.$user->username}}</span>
                </div>
            </a>
        @endforeach
        @foreach ($posts as $post)
            <a href="post/{{$post->id}}">
                <div class="flex flex-col gap-2 my-2 border rounded border-blue-300 p-3 shadow-blue-300 shadow-sm">
                    <div class="flex gap-2 items-center">
                        <span>{{'u/'.$post->username}}</span>
                        <span class="text-xs">{{$post->updated_at->diffForHumans()}}</span>
                    </div>
                    <div class="flex flex-col gap-2 justify-center">
                        <span class="text-xl font-bold">{{$post->title}}</span>
                        <span class="truncate max-w-full">{{$post->description}}</span>
                    </div>
                </div>
            </a>
        @endforeach
        @if (count($users) == 0 && count($posts) == 0)
            <div class="p-5 flex flex-col items-center">
                <img class="ms-10 w-[200px] h-[200px]" src="{{asset('assets/images/no_comment_gif.gif')}}" alt="">
                <span class="text-xl font-thin">{{__('No results found.')}}</span>
            </div>
        @endif
    
    @elseif($search == '')
        <div class="p-5 flex flex-col items-center">
            <img class="ms-10 w-[200px] h-[200px]" src="{{asset('assets/images/no_comment_gif.gif')}}" alt="">
            <span class="text-xl font-thin">{{__('Search for users and posts.')}}</span>
        </div>
    @endif
</div>

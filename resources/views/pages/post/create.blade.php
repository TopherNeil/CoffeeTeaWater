<x-layout>
    <x-navbar></x-navbar>
    <x-card class="w-[600px] rounded border border-slate-200 h-auto p-10 mt-[90px]">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Create a Post</h2>
            <p class="mb-4">Post anything!</p>
          </header>
      
          <form method="POST" action="/post" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
              <label for="title" class="inline-block text-lg mb-2">Title</label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                value="{{old('title')}}" />
      
              @error('title')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>
      
            <div class="mb-6">
              <label for="description" class="inline-block text-lg mb-2">Description</label>
              <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                placeholder="I think this is an awesome post.">{{old('description')}}</textarea>
      
              @error('description')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>
      
            <div class="mb-6">
              <label for="photo" class="inline-block text-lg mb-2">
                Photo
              </label>
              <input type="file" class="border border-gray-200 rounded p-2 w-full" name="photo" accept="image/png, image/jpeg, image/jpeg"/>
      
              @error('media')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div>
      
            <div class="mb-6">
              <x-button name="Create Post" severity="secondary" />
      
              <a href="/home" class="text-black ml-4"> Back </a>
            </div>
          </form>
    </x-card>
</x-layout>
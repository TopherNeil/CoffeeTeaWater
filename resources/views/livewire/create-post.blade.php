<div>
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">{{ __('Create a Post') }}</h2>
        <p class="mb-4">{{ __('Post anything!') }}</p>
    </header>

    <form wire:submit.prevent="save">
        <!-- Title Field -->
        <div class="mb-6">
            <label for="title" class="inline-block text-lg mb-2">{{ __('Title') }}</label>
            <input type="text" id="title" name="title" class="border border-gray-200 rounded p-2 w-full"
                wire:model="title" value="{{ old('title') }}" required />
            @error('title')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="mb-6">
            <label for="description" class="inline-block text-lg mb-2">{{ __('Description') }}</label>
            <textarea id="description" name="description" rows="10" class="border border-gray-200 rounded p-2 w-full"
                wire:model="description" placeholder="I think this is an awesome post." required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Photo Upload Field -->
        <div class="mb-6">
            <label for="photo" class="inline-block text-lg mb-2">{{ __('Photo') }}</label>
            <input type="file" class="border border-gray-200 rounded p-2 w-full" wire:model="photo"
                accept=".jpg, .jpeg, .gif, .png" />
            @error('photo')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror

            <!-- Image Preview -->
            @if ($photo)
                <div class="mt-4">
                    <p class="mb-2">{{ __('Image Preview:') }}</p>
                    <div class="bg-slate-400 rounded flex justify-center h-[200px] w-[200px] ">
                        <a href="{{ Storage::disk('local')->url('livewire-tmp/' . $photo->getFilename()) }}"
                            target="_blank"><img class="bg-slate-300 rounded h-[200px] w-[200px]"
                                src="{{ Storage::disk('local')->url('livewire-tmp/' . $photo->getFilename()) }}"
                                alt="Temporary Image">
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Form Buttons -->
        <div class="mb-6 flex items-center">
            <x-button severity="secondary" name="Create Post" />
            <a href="/home" class="text-black ml-4">{{ __('Back') }}</a>
        </div>
    </form>
</div>

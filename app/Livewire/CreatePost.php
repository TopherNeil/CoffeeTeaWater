<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{
    use WithFileUploads;

    #[Rule('nullable|mimes:jpg,png,jpeg|max:2048')]
    public $photo;

    #[Rule('required|string|max:255')]
    public $title;

    #[Rule('required|string|max:1000')]
    public $description;

    public $user_id;

    public function save()
    {
        try {
            $this->user_id = Auth::user()->id;

            $validated = $this->validate();
            $validated['user_id'] = $this->user_id;

            if ($this->photo) {
                $validated['photo'] = $this->photo->store('images/posts', 'local');
            }

            Post::create($validated);

            return redirect('home')->with('message', 'Posted!');
        } catch (\Exception $e) {
            report($e);
            session()->flash('error', 'There was an error posting.');
        }
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}

<?php

namespace App\Livewire;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Like as Liker;

class Like extends Component
{
    public $isLiked;
    public $post_id;
    public $number_of_likes;

    public function mount($post_id)
    {
        $this->post_id = $post_id;
        $this->isLiked = Liker::where('user_id', Auth::id())
                              ->where('post_id', $this->post_id)
                              ->exists();

        $this->number_of_likes = Liker::where('post_id', $this->post_id)
                                      ->count();
    }

    public function toggleLike() 
    {
        $user_id = Auth::id();

        if(!$this->isLiked) {
            
            $existingLike = Liker::where('user_id', $user_id)
                                ->where('post_id', $this->post_id)
                                ->exists();
    
            if (!$existingLike) {
                Liker::create([
                    'user_id' => $user_id,
                    'post_id' => $this->post_id
                ]);
            }

        } else {
            
            $like = Liker::where('post_id', $this->post_id)
                        ->where('user_id', $user_id)
                        ->first();
                        
            if ($like) {
                $like->delete();
            }                        
        }

        $this->isLiked = !$this->isLiked;
        $this->number_of_likes = Liker::where('post_id', $this->post_id)
                                      ->count();
    }

    public function render()
    {
        return view('livewire.like');
    }
}

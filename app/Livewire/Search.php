<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $users = [];
    public $posts = [];

    public function researchUser()
    {
         $this->users = User::where('username', 'LIKE', '%'.$this->search.'%')->get();
         $this->posts = Post::leftJoin('users', 'users.id', '=', 'posts.user_id')
                            ->select('users.profile_picture as profile_picture', 
                                     'users.username', 'posts.title as title', 
                                     'posts.id as id', 
                                     'posts.description as description', 
                                     'posts.updated_at as updated_at',)
                            ->where('title', 'LIKE', '%'.$this->search.'%')
                            ->get();
    }

    public function render()
    {
        return view('livewire.search');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() 
    {
        $currentUser = Auth::user();
        $posts = Post::leftJoin('users', 'users.id', 'posts.user_id')
                        ->select('users.username as username', 'posts.user_id as user_id', 'posts.id as post_id', 'posts.created_at', 'posts.title', 'posts.description', 'posts.photo')
                        ->where('users.id', $currentUser->id)
                        ->get();
        return view('pages.profile.index', ['user' => $currentUser, 'posts' => $posts]);
    }

    public function edit()
    {
        $currentUser = Auth::user();
        return view('pages.profile.edit', ['user' => $currentUser]);
    }

    public function update(Request $request) 
    {
        try {
            
            $form = $request->validate([
                'profile_picture' => 'nullable|mimes:png,jpg'
            ]);
            $currentUserId = Auth::user()->id;
            $currentUser = User::findOrFail($currentUserId);
            if ($request->hasFile('profile_picture'))
            {
                $form['profile_picture'] = $request->file('profile_picture')->store('images', 'public');
            } else {
                $form['profile_picture'] = null;
            }
    
            $currentUser->update($form);
            return redirect('profile');

        } catch (\Exception $e) {
            report($e);
        }
    }
}

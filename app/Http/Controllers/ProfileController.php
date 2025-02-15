<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        try {

            $currentUser = Auth::user();
            $posts = Post::leftJoin('users', 'users.id', '=', 'posts.user_id')
                ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
                ->leftJoin('likes', 'likes.post_id', '=', 'posts.id')
                ->select(
                    'users.username as username',
                    'posts.user_id as user_id',
                    'posts.id as post_id',
                    'posts.created_at',
                    'posts.title',
                    'posts.description',
                    'posts.photo',
                    DB::raw('GROUP_CONCAT(likes.user_id) as likers'),
                    DB::raw('COUNT(DISTINCT likes.user_id) as likes_count'),
                    DB::raw('COUNT(comments.id) as comment_count')
                )
                ->where('users.id', $currentUser->id)
                ->groupBy('users.username', 'posts.user_id', 'posts.id', 'posts.created_at', 'posts.title', 'posts.description', 'posts.photo')
                ->get();

            $posts = $posts->map(function ($post) {
                $post->likers = $post->likers ? explode(',', $post->likers) : [];
                return $post;
            });

            return view('pages.profile.index', ['user' => $currentUser, 'posts' => $posts]);
        } catch (\Exception $e) {
            report($e);
        }
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
            if ($request->hasFile('profile_picture')) {
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

    public function show($username)
    {
        try {

            $userToVisit = User::select('id', 'username', 'email', 'profile_picture')->where('username', '=', $username)->first();
            $posts = Post::leftJoin('users', 'users.id', '=', 'posts.user_id')
                ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
                ->leftJoin('likes', 'likes.post_id', '=', 'posts.id')
                ->select(
                    'users.username as username',
                    'posts.user_id as user_id',
                    'posts.id as post_id',
                    'posts.created_at',
                    'posts.title',
                    'posts.description',
                    'posts.photo',
                    DB::raw('GROUP_CONCAT(likes.user_id) as likers'),
                    DB::raw('COUNT(DISTINCT likes.user_id) as likes_count'),
                    DB::raw('COUNT(comments.id) as comment_count')
                )
                ->where('users.id', $userToVisit->id)
                ->groupBy('users.username', 'posts.user_id', 'posts.id', 'posts.created_at', 'posts.title', 'posts.description', 'posts.photo')
                ->get();

            $posts = $posts->map(function ($post) {
                $post->likers = $post->likers ? explode(',', $post->likers) : [];
                return $post;
            });

            return view('pages.profile.show', ['user' => $userToVisit, 'posts' => $posts]);
        } catch (\Exception $e) {
            report($e);
        }
    }
}

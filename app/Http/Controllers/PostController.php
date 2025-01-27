<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request) 
    {
        try {
            
            $posts = Post::leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('comments', 'comments.post_id', '=', 'posts.id')
            ->select(
                'posts.id as id',
                'posts.user_id as user_id',
                'users.username as username',
                'posts.title as title',
                'posts.created_at as created_at',
                'posts.description as description',
                'posts.photo as photo',
                DB::raw('COUNT(comments.id) as comment_count'))
            ->groupBy('posts.id', 'posts.user_id', 'users.username', 'posts.title', 'posts.created_at', 'posts.description', 'posts.photo')
            ->latest()
            ->get();

            return view('pages.home', compact('posts'));

        } catch (\Exception $e) {
            report($e);
        }   
    }

    public function create()
    {
        return view('pages.post.create');
    }

    public function store(Request $request)
    {
        try {

            $form = $request->validate([
                'title' => 'required|string|max:55', 
                'description' => 'required|string|max:255'
            ]);
    
            $form['user_id'] = Auth::user()->id;
    
            if($request->hasFile('photo'))
            {
                $form['photo'] = $request->file('photo')->store('images', 'public');
            }
            
            Post::create($form);
    
            return redirect('home')->with('message', 'Posted!');

        } catch (\Exception $e) {
            report($e);
        } 
    }

    public function show($id) 
    {
        try {
          
            $post = Post::leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->where('posts.id', $id)
                    ->select('posts.id as id', 'posts.user_id as user_id', 
                             'users.username as username', 'users.profile_picture as profile_picture', 'posts.title as title', 
                             'posts.created_at as created_at', 'posts.description as description', 
                             'posts.photo as photo')
                    ->first();

            $comments = Comment::leftJoin('posts', 'posts.id', '=', 'comments.post_id')
                        ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                        ->select('comments.content as content', 'users.username as username', 'users.profile_picture as profile_picture', 'comments.created_at as created_at')
                        ->where('posts.id', $id)
                        ->paginate(5);
            
            return view('pages.post.show', compact('post', 'comments'));

        } catch (\Exception $e) {
            report($e);
        } 
    }

    public function edit($id)
    {
        try {
            
            $post = Post::leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->select('posts.id as id', 'posts.user_id as user_id', 
                             'users.username as username', 'posts.title as title', 
                             'posts.created_at as created_at', 'posts.description as description', 
                             'posts.photo as photo')
                             ->where('posts.id', $id)
                             ->first()
                             ->toArray();
                 
            if (Auth::user()->id === $post['user_id']) {
                return view('pages.post.edit', compact('post'));
            }
                
            return redirect('home');

        } catch (\Exception $e) {
            report($e);
        }
        
    }

    public function update(Request $request, $id)
    {
        try {

            $form = $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);
    
            $post = Post::findOrFail($id);
    
            if($request->hasFile('photo')) {
                $form['photo'] = $request->file('photo')->store('images', 'public');
            }
    
            $post->update($form);
    
            return redirect('home');

        } catch (\Exception $e) {
            report($e);
        }
    }

    public function destroy($id)
    {
        try {

            $post = Post::findOrFail($id);
            $post->delete();
            return redirect('home');
            
        } catch(\Exception $e) {
            report($e);
        }
        
    }
}

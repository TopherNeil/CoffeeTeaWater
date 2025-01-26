<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request) 
    {
        $posts = Post::leftJoin('users', 'users.id', 'posts.user_id')
                    ->select('posts.id as id', 'posts.user_id as user_id', 
                             'users.username as username', 'posts.title as title', 
                             'posts.created_at as created_at', 'posts.description as description', 
                             'posts.photo as photo')
                    ->latest()->get();
        return view('pages.home', compact('posts'));
    }

    public function create()
    {
        return view('pages.post.create');
    }

    public function store(Request $request)
    {
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
        
    }

    public function show($id) 
    {
        $post = Post::leftJoin('users', 'users.id', 'posts.user_id')->where('posts.id', $id)
                    ->select('posts.id as id', 'posts.user_id as user_id', 
                             'users.username as username', 'posts.title as title', 
                             'posts.created_at as created_at', 'posts.description as description', 
                             'posts.photo as photo')
                    ->first();
        $comments = [
            ['commenter_name' => "Chon Gomez" , 'comment' => 'Hello, have a great week!'],
            ['commenter_name' => "Monica Jalva" , 'comment' => 'Hello, have a great month!'],
            ['commenter_name' => "Kyedae Ishmyta" , 'comment' => 'Hello, have a great year!']
        ];
        return view('pages.post.show', compact('post', 'comments'));
    }

    public function edit($id)
    {
        $post = Post::leftJoin('users', 'users.id', 'posts.user_id')
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
    }

    public function update(Request $request, $id)
    {
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

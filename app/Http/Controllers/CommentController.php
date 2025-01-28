<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $post_id)
    {
        try {

            $form = $request->validate([
                'content' => 'required|string|max:10000'
            ]);
    
            $form['user_id'] = Auth::id();
            $form['post_id'] = $post_id;
    
            try {
                Comment::create($form);
                return redirect()->back();
            } catch (\Exception $e) {
                report($e);
            }

        } catch (\Exception $e) {
            report($e);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post_id, $comment_id)
    {
        try {
          
            $post = Post::leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->where('posts.id', $post_id)
                    ->select('posts.id as id', 'posts.user_id as user_id', 
                             'users.username as username', 'users.profile_picture as profile_picture', 'posts.title as title', 
                             'posts.created_at as created_at', 'posts.description as description', 
                             'posts.photo as photo')
                    ->first();

            $comment = Comment::findOrFail($comment_id)->toArray();
            
            return view('pages.post.comment.edit', compact('post', 'comment'));

        } catch (\Exception $e) {
            report($e);
        } 
        return view('pages.post.comment.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post_id, $comment_id)
    {
        try {

            $form = $request->validate(['content' => 'required|max:10000']);
            $comment = Comment::findOrFail($comment_id);

            $comment->update($form);

            return redirect('post/'.$post_id);

        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $comment = Comment::findOrFail($id);
            $comment->delete();

            return redirect()->back();
            
        } catch(\Exception $e)
        {
            report($e);
        }
        


    }
}

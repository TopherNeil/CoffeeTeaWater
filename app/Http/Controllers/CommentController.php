<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\delete;

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
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
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

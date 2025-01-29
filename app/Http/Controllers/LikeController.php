<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Route;

class LikeController extends Controller
{
    public function store($post_id)
    {
        try {
            $user_id = Auth::id();
    
            // Check if the user already liked the post to prevent duplicates
            $existingLike = Like::where('user_id', $user_id)
                                ->where('post_id', $post_id)
                                ->exists();
    
            if (!$existingLike) {
                Like::create([
                    'user_id' => $user_id,
                    'post_id' => $post_id
                ]);
            }
    
            $previousUrl = url()->previous();

            if (str_contains($previousUrl, 'home')) {
                return redirect("home/#{$post_id}");
            } elseif (str_contains($previousUrl, 'profile')) {
                return redirect("profile/#{$post_id}");
            }

            return back();
    
        } catch (\Exception $e) {
            report($e);
            return back()->with('error', 'Something went wrong while liking the post.');
        }
    }
  
    public function destroy($post_id)
    {
        try {
            $user_id = Auth::id();
    
            $like = Like::where('post_id', $post_id)
                        ->where('user_id', $user_id)
                        ->first();
    
            if ($like) {
                $like->delete();
            }
            
            $previousUrl = url()->previous();

            if (str_contains($previousUrl, 'home')) {
                return redirect("home/#{$post_id}");
            } elseif (str_contains($previousUrl, 'profile')) {
                return redirect("profile/#{$post_id}");
            }

            return back();

        } catch (\Exception $e) {
            report($e);
            return back()->with('error', 'Something went wrong while unliking the post.');
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use Session;

class CommentController extends Controller
{
    public function index(Request $request) {
        $this->validate($request, [
            'post_id' => 'exists:posts,id|numeric',
            'comment' => 'required|max:255'
        ]);
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();

        Session::flash('success', 'Dodano komentarz');
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (Auth::user()->id != $comment->user_id) {
            abort(404);
        }
        if ($comment == null) {
            abort(404);
        }
        
        $comment->delete();
        Session::flash('success', 'Usunięto komentarz');
        return redirect()->back();
    }
    
    
}

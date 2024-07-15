<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function postComment(Request $request)
    {
       $postComment=  PostComment::create([
           'post_id'=>$request->post('productId'),
           'user_id'=>$request->post('userId'),
           'comment'=>$request->post('post_comment'),
           'parent_id'=>$request->post('parent_id'),
        ]);

       if ($postComment){
           return redirect()->back()->with(['success'=>'Comment added successfully.']);
       }else{
           return redirect()->back()->with(['error'=>'Try Again']);
       }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: zombie
 * Date: 12/5/2019
 * Time: 7:38 AM
 */

namespace  App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentFormRequest;

class CommentsController extends Controller{
    public function newComment(CommentFormRequest $request){
        $comment = new Comment(array(
            'post_id' => $request->get('post_id'),
            'content' => $request->get('commentContent')
        ));

        $comment->save();
        return redirect()->back()->with('status', "Your comment has been created.");
    }
}
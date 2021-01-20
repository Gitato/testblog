<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentFormRequest $request)
    {
        if(Auth::user()) {
            $input['from_user'] = $request->user()->id;
        }
        $input['on_post'] = $request->input('on_post');
        $input['body'] = $request->input('body');
        $id = $request->input('id');
        Comment::create($input);
        return redirect('show/'.$id)->with('message', 'Comment published');
    }
    public function answer(CommentFormRequest $request)
    {
        if(Auth::user())
        {
            $input['from_user'] = $request->user()->id;
        }
        $input['on_comment'] = $request->input('on_comment');
        $input['body']=$request->input('body');
        $id = $request->input('id');
        Comment::create($input);
        return redirect('show/'.$id)->with('message','Answer published');
    }

}

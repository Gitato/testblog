<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function user_posts($id)
    {
        $posts = Post::where('author_id',$id)->orderBy('created_at','desc')->paginate(15);
        $title = User::find($id)->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }

    public function user_posts_all(Request $request)
    {
        $user = $request->user();
        $posts = Post::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(15);
        $title = $user->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }
    public function profile(Request $request,$id)
    {
        $data['user'] = User::find($id);
        if (!$data['user'])
            return redirect('/home');
        if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
            $data['author'] = true;
        } else {
            $data['author'] = null;
        }
        $data['comments_count'] = $data['user'] -> comments -> count();
        $data['posts_count'] = $data['user'] -> posts -> count();
        $data['latest_posts'] = $data['user'] -> posts -> take(5);
        $data['latest_comments'] = $data['user'] -> comments -> take(5);
        return view('profile', $data);
    }
    public function UploadAvatar(Request $request, $id)
    {
//        $path=$request->file('avatar')->store('uploads','public');
//        return view('profile',['path'=>$path]);
        $user=User::where('id',$id)->first();
        if(! Auth::user()->id === $user->id)
        {
            return redirect()->route('home');
        }
        if ( $request->hasFile('avatar'))
        {
            $user->clearAvatars($user->id);
            $avatar = $request->file('avatar');
            $filename=time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300,300)
                ->save(public_path($user->getAvatarsPath($user->id) ) . $filename);

            $user= Auth::user();
            $user->avatar=$filename;
            $user->save();
            return back();
        }
    }
}

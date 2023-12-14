<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class postcontroller extends Controller
{
    public function createPost(Request $request){
        $incomingFields= $request->validate([
            "title"=> "required",
            "body"=> "required",
        ]);

        $incomingFields['user_id']=auth()->id();
        Post::create($incomingFields);

        return redirect('/');
    }


}

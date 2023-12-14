<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class asmaacontroller extends Controller
{
    public function login(Request $request){
        $t = $request->validate([
            'loginname' => 'required',
            'loginPassword'=> 'required',
        ]);

        if(auth()->attempt(['name' => $t['loginname'], 'password' => $t['loginPassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request){
        $testvValidate= $request->validate([
            'name'=> ['required','min:3','max:10', Rule::unique('users','name')],
            'email'=> ['required','email', Rule::unique('users','email')],
            'password'=> ['required','min:3','max:200']
        ]);
        $testvValidate['password']= bcrypt($testvValidate['password']);
        $user = User::create($testvValidate);
        auth()->login($user);
        return redirect('/');
    }

    public function edit(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        return view('edit-post',['post' => $post]);

    }

    public function update_post(Post $post, Request $request ){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incomingFields= $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post->update($incomingFields);
        return redirect('/');
    }

    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }

        return redirect('/');

    }
}

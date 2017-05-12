<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller
{
    //
    public function create(){
      return view('sessions.create');
    }

    public function store(Request $request){
      $this->validate($request, [
        'email' => 'required|email|max:255',
        'password' => 'required'
      ]);
      $credentials = [
      'email' => $request->email,
      'password' => $request->password,
      ];
      if (Auth::attempt($credentials)){
        //成功
        session()->flash('success', '欢迎回来');
        return redirect()->route('users.show', [Auth::user()]);
      } else {
        //失败
        session()->flash('danger', '很抱歉，登录失败！');
        return redirect()->back();
      }
    }

    public function destroy(){
      Auth::logout();
      session()->flash('success', '您已成功退出');
      return redirect('login');
    }

}

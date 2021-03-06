<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
           'only' => ['create']
        ]);
    }

    //用户登录页面
    public function create(){
        return view('sessions.create');
    }

    //用户登录:创建新会话
    public function store(Request $request){
        //验证数据格式
        $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required',
        ]);

        //进行用户认证
        if (Auth::attempt($credentials, $request->has('remember'))){
            if (Auth::user()->activated){
                session()->flash('success', '欢迎回来！');
                return redirect()->intended(route('users.show', [Auth::user()]));
            } else {
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活!');
                return redirect()->route('home');
            }

        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }

    }

    //用户登出：销毁会话
    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功退出!');
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['create', 'store', 'show', 'confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //创建用户的页面
    public function create(){
        return view('users.create');
    }

    //创建用户、发送激活邮件
    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $this->sendEmailConfirmationTo($user);

        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收!');

        return redirect()->route('home');

    }


    //发送激活邮件函数
    public function sendEmailConfirmationTo($user){
        $view = 'emails.confirm';
        $data = compact('user');
        $from = '706932644@qq.com';
        $name = 'sailor';
        $to = $user->email;
        $subject = '欢迎 ' . $user->name . ' 注册 sailor 微博的账号！';

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }


    //编辑用户个人资料的页面
    public function edit(User $user){
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //更新用户
    public function update(User $user, Request $request){

        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password){
            $data['password'] = $request->password;
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }

    //显示所有用户列表的页面
    public function index(){
        $users = User::paginate(15);
        return view('users.index', compact('users'));
    }

    //显示用户个人信息的页面
    public function show(User $user){
        return view('users.show', compact('user'));
    }

    //删除用户
    public function destroy(User $user){

        $this->authorize('delete', $user);

        $user->delete();

        session()->flash('success', '您已成功删除该用户！');

        return back();

    }

    public function confirmEmail($token){
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->update(['activated' => true, 'activation_token' => '']);

        Auth::login($user);

        session()->flash('success', '恭喜你，激活成功！');

        return redirect()->route('users.show', [$user]);

    }


}

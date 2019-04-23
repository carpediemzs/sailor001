<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    //创建用户的页面
    public function create(){
        return view('users.create');
    }

    //创建用户
    public function store(){

    }

    //编辑用户个人资料的页面
    public function edit(){

    }

    //更新用户
    public function update(){

    }

    //显示所有用户列表的页面
    public function index(){

    }

    //显示用户个人信息的页面
    public function show(User $user){
        return view('users.show', compact('user'));
    }

    //删除用户
    public function destroy(){

    }


}

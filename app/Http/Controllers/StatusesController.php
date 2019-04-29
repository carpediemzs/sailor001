<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }




    public function store(Request $request)
    {
        //校验微博内容-限制字数
        $this->validate($request, [
           'content' => 'required|max:140'
        ]);

        //创建微博，并和用户-user关联
        Auth::user()->status()->create([
           'content' => $request['content']
        ]);

        session()->flash('success', '发布成功！');

        return redirect()->back();




    }


    public function destroy(Status $status)
    {
        //
    }
}

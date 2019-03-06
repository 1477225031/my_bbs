<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    //使用user模型
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user)
    {
        //userRequest调整需要接收的值

        dd($request->all());
        $user->update($request->all());
        return redirect()->route('users.show',$user->id)->with('success','资料更新成功');
    }

    //store保存修改后的逻辑

}

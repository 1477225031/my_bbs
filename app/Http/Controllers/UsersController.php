<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

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

    public function update(UserRequest $request,ImageUploadHandler $uploder,User $user)
    {
        //userRequest调整需要接收的值
        //判断上传是否通过
        //获取所有数据
        $data = $request->all();
        if($request->avatar) {
            $result = $uploder->save($request->avatar,'avatars',$user->id);
            //如果返回不是false
            if($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','资料更新成功');
    }

    //store保存修改后的逻辑

}

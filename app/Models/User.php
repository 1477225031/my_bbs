<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use Notifiable, MustVerifyEmailTrait;

    //发送认证邮件
    public function register(Request $request)
    {
        // 检验用户提交的数据是否有误
        $this->validator($request->all())->validate();

        // 创建用户同时触发用户注册成功的事件，并将用户传参
        event(new Registered($user = $this->create($request->all())));

        // 登录用户
        $this->guard()->login($user);

        // 调用钩子方法 `registered()`
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}

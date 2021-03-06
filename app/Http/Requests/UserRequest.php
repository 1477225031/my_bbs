<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //接收的规则
        //名字必须填写,
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:88',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208'
        ];
    }

    /*
     * 自定义错误信息
     * 返回错误信息
     */
    public function messages()
    {
        return [
          'avatar.mimes' => '头像必须 jpeg,bmp,png,gif格式的图片',
          'avatar.dimensions' => '图片的分辨率不够清晰,宽和高需要在208px以上',
          'name.unique' => '用户名已被占用,请重新填写',
          'name.regex'  => '用户名只支持,英文.数字和下划线',
          'name.between' => '用户名必须介于 3 - 25 个字符之间',
          'name.required' => '用户名必须填写',
        ];
    }
}

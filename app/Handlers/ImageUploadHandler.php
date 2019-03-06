<?php
namespace App\Handlers;

class ImageUploadHandler
{
    //允许的格式
    protected $allow_ext = ['png','jpeg','gif','jpeg','jpg'];

    //上传逻辑
    //回忆下,上传文件都需要什么 file对象,file文件夹名称,文件名前缀
    public function save($file, $folder, $file_prefix)
    {
        //文件规格
        $folder_name = "/upload/image/$folder/".date('Ym/d',time());

        //拼接完整路径
        $upload_path = public_path().'/'.$folder_name;

        //裁剪照片后后缀为空,要确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';

        //拼接完整的文件名 前缀
        $filename = $file_prefix.'_'.time().'_'.str_random(10).'.'.$extension;

        //判断后缀是否合法
        if(!in_array($extension, $this->allow_ext)) {
            return false;
        }

        //移动临时图片到路径
        $file->move($upload_path,$filename);

        //返回文件的路径和名称
        return [
              'path' => config('app.url')."$folder_name/$filename"
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsers extends FormRequest
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
        return [    
            'uname' => 'required|regex:/^[a-z]{1}[\w]{5,17}$/',
            'email' => 'required|regex:/^[\w]+@[\w]+\.[\w]+$/',
           'phone' => 'required|regex:/^[\w]{5,17}$/',
        ];
    }
    // 自定义错误消息
    public function messages()
    {
        return [
            'uname.required'=>'用户名必填',
            'uname.regex'=>'用户名格式不正常',
            'email.required'=>'用户名必填',
            'email.regex'=>'邮箱格式不正常',
            'phone.required'=>'电话必填',
            'phone.regex'=>'电话格式不正常',
        ];
    }
}

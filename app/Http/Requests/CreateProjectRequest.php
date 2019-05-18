<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProjectRequest extends FormRequest
{

    #エラー定義
    protected $errorBag = 'create';
    /**
     * Determine if the user is authorized to make this request.
     * 現在のユーザー権限あるかの判断
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
            'name'=>[
                'required',
                Rule::unique('projects')->where(function ($query){
                    return $query->where('user_id', request()->user()->id);
                })
            ],
            'thumbnail'=>'image|dimensions:min_width=260,min_height=100|max:2048'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>'プロジェクト名は必須項目です',
          'name.unique'=>'同じ名前のプロジェクト存在します',
          'thumbnail.image'=>'画像ファイルしかし受け付けませ',
          'thumbnail.dimensions'=>'画像ファイルのサイズは規格外',
          'thumbnail.max'=>'2mまでの画像を使用してください'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTask extends FormRequest
{

    protected $errorBag = 'create';
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
            'name'=>[
                'required',
                'max:50',
                Rule::unique('tasks')->where(function ($query){
                    $query->where('project_id',$this->project);
                })
            ],
            'project'=>[
                'required',
                'integer',
                Rule::exists('projects','id')->whereIn('id',$this->user()->projects()->pluck('id')->toArray())
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'内容を入力してください',
            'name.max'=>'50文字以内で入力してください',
            'name.unique'=>'同じミッションが存在します',
            'project_id.exists'=>'該当するプロジェクト存在しません',
            'project_id.integer'=>'フォームを修正しないでください',
            'project_id.required'=>'フォームを修正しないでください'
        ];
    }


}

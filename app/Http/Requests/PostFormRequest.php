<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $postId = $this->route('id');
//        dd($postId);
        return [
            'title'=>['required','max:255',Rule::unique('posts')->ignore($postId)],
            'body'=>'required',
            'tag'=>['required','max:255']
//                ,Rule::unique('tags_relationship','tag_id')
//                ->where(function ($query)
//                {
//                    return $query->where('post_id',$this->post_id);
//                }
//                )->ignore($postId)],
        ];
    }
}

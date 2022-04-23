<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePostRequest extends FormRequest
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
           
                'title' =>['required' , 'min:3' , Rule::unique('posts','title')->ignore($this->post)],
                'description' =>['required', 'min:10'],
              
            
        ];
    }

    public function messages()
    {
        return [
            'title.required' =>'title is required', 
            'title.min'=>'title must be at least 3 characters',
            'title.unique' => 'title must be unique',
            'description.required'=>'description is required',
            'description.min'=> 'description must be at least 10 characters' ,
            
        ];
    }
}
  
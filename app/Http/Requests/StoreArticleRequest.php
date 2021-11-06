<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
        if(request()->routeIs('articles.store')) {
            $imageRule = 'image|required' ;
        } elseif(request()->routeIs('articles.update')){
             $imageRule = 'image|sometimes' ;
        }

        return [
            'title' => 'required',
            'content' => 'required',
            'image' => $imageRule,
            'categorie' => 'required'
        ];
    }

    protected function prepareForValidation() {

        if($this->image == null) {
            $this->request->remove('image') ;
        }
    }

}

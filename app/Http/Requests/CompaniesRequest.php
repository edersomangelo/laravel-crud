<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = [
            'name'=>'required|min:2',
            'email' => 'required|email|min:10',
            'website'=>[function($attribute, $value, $fail){
                if (!preg_match(
                    '/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/',
                    $value
                )){
                    $fail(':attribute must be a url');
                }
            }]
        ];

        if ($this->hasFile('logo') || !$this->filled('id'))
            $return['logo'] = 'dimensions:min_width=100,min_height=100';

        return $return;
    }
}

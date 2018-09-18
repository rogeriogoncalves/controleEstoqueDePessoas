<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
        'name'          => 'required|min:3|max:100',  ///Preenchimento obrigatorio, quantidade minima de 3 caracteres e maxima de 100 caracteres
        'number'        => 'required|numeric',
        'category'      => 'required',
        'description'   => 'required|min:3|max:1000',
        ];
    }
    public function messages() {
        return     ['name.required' => 'O campo nome é de preenchimento obrigatorio!', 
                    'number.required' => 'O campo numero é de preenchimento obrigatorio!',
                    'number.numeric' => 'Neste campo é permitido apenas números!',
                    'description.required' => 'A descrição deve ser preenchida!',
                    'description.max'=> 'A quantidade de caracteres ultrapassou o limite permitido',
                    'description.min'=> 'A quantidade de caracteres não alcançou o limite minimo permitido'];
    }
}

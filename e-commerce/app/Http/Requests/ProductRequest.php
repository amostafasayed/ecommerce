<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = count($this->route()->parameters()) ? $this->route()->parameters()['product']:'';
        return [
            'name'=>'required',
            'sku_number'=>'required|unique:products,sku_number,'.$id,
            'price'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
            'status'=>'required',
            'is_out_of_stock'=>'required',
        ];
    }
}

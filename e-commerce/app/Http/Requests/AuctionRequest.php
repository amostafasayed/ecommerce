<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuctionRequest extends FormRequest
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
            'name'=>'required',
            'product_id'=>'required',
            'auction_type'=>'required',
            'starting_price'=>'required',
            'cost_per_bid'=>'required',
            'price_increase_every_bid'=>'required',
            'status'=>'required',
        ];


    }
}

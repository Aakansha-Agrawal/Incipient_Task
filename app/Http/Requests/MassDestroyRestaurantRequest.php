<?php

namespace App\Http\Requests;

use App\Restaurant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyRestaurantRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('restaurant_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:restaurants,id',
        ];
    }
}
<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CatalogRequest extends Request
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
            'city_id' => 'required|exists:cities,id',
            'images.*.file' => 'image:jpeg,png,gif|size:3145728|dimensions:min_width=200,min_height=200',
            'regenerateSlug' => 'boolean',
        ];
    }
}

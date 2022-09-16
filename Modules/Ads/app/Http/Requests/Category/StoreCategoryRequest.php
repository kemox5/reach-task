<?php

namespace Modules\Ads\App\Http\Requests\Category;

use App\Http\Requests\ApiRequest;

class StoreCategoryRequest extends ApiRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:categories,name'],
        ];
    }
}

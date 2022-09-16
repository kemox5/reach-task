<?php

namespace Modules\Ads\App\Http\Requests\Category;

use App\Http\Requests\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Ads\App\Models\Category;

class UpdateCategoryRequest extends ApiRequest
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
        $category = $this->route('category');
        
        return [
            'name' => ['nullable', Rule::unique('categories', 'name')->where('id', '!=', $category->id)],
        ];
    }
}

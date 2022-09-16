<?php

namespace Modules\Ads\App\Http\Requests\Tag;

use App\Http\Requests\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends ApiRequest
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
        $tag = $this->route('tag');
        
        return [
            'name' => ['nullable', Rule::unique('tags', 'name')->where('id', '!=', $tag->id)],
        ];
    }
}

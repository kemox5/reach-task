<?php

namespace Modules\Ads\App\Http\Requests\Ad;

use App\Http\Requests\ApiRequest;

class UpdateAdRequest extends ApiRequest
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
            'type' => ['nullable', 'in:free,paid'],
            'title' => ['nullable'],
            'description' => ['nullable'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'advertiser_id' => ['nullable', 'exists:advertisers,id'],
            'start_date' => ['nullable', 'date'],
            'tags' => ['array', 'nullable'],
            'tags.*' => ['exists:tags,id']
        ];
    }
}

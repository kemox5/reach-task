<?php

namespace Modules\Ads\App\Http\Requests\Ad;

use App\Http\Requests\ApiRequest;

class StoreAdRequest extends ApiRequest
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
            'type' => ['required', 'in:free,paid'],
            'title' => ['required'],
            'description' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'advertiser_id' => ['required', 'exists:advertisers,id'],
            'start_date' => ['required', 'date']
        ];
    }
}

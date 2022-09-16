<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{

      /**
       * Validate the class instance.
       *
       * @return void
       */
      public function validateResolved()
      {
            $this->prepareForValidation();

            if (!$this->passesAuthorization()) {
                  $this->failedAuthorization();
            }

            $instance = $this->getValidatorInstance();

            if ($instance->fails()) {
                  $this->failedApiValidation($instance);
            }

            $this->passedValidation();
      }


      /**
       * Handle a failed validation attempt.
       *
       * @param  \Illuminate\Contracts\Validation\Validator  $validator
       * @return void
       *
       * @throws \Illuminate\Validation\ValidationException
       */
      protected function failedApiValidation(Validator $validator)
      {
            throw new HttpResponseException(response()->json([
                  'success'   => false,
                  'message'   => 'Validation errors',
                  'errors'      => $validator->errors()
            ], 422));
      }
}

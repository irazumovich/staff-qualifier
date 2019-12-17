<?php

namespace App\Http\Requests;

use App\Qualification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateQualificationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('qualification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'                  => [
                'required',
            ],
            'sign'                  => [
                'required',
            ],
            'next_qualification'    => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'qualification_goals.*' => [
                'integer',
            ],
            'qualification_goals'   => [
                'array',
            ],
        ];
    }
}

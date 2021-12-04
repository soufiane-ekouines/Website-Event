<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'user_id'=>['required'],
            'Name' => ['required', 'string','max:255'],
            'desc'=> ['required', 'string','max:355'],
            'date_debut' => ['required', 'date','date_format:Y-m-d','after:today'],
            'date_fin_p'=> ['nullable', 'date','date_format:Y-m-d','after:today'],
            'prix'=> ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'qte'=>['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'img'=> ['nullable', 'string'],
            'Adresse'=> ['required', 'string','max:455']
        ];
    }
}

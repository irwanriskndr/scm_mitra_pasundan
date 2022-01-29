<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jurusan_id' => 'required|exists:jurusan,id',
            'nisn' => 'required|string|max:10|min:10',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'phone_number' => 'required|string|max:12|min:11',
            'gender' => 'required|string|max:255',
            'status' => 'required|string|max:255|in:TERSEDIA,BEKERJA,KULIAH',
        ];
    }
}

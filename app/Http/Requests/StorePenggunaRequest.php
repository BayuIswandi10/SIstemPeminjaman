<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenggunaRequest extends FormRequest
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
            'nama' => ['required', 'max:250'],
            'alamat' => ['required', 'max:250'],
            'nohp' => ['required', 'max:250'],
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'role' => ['required', 'max:250'],
            'main_job' => ['required', 'max:250'],
            'other_job' => ['required', 'max:250'],
            'status' => ['required', 'max:250'],
            'username' => ['required', 'max:250'],
            'password' => ['required', 'max:250'],
        ];
    }
    

    public function messages()
    {
        return [
            'required' => 'Kolom :attribute harus diisi.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'image' => 'Kolom :attribute harus berupa gambar.',
            'mimes' => 'Kolom :attribute harus berupa file dengan tipe: :values.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max kilobita.',
        ];
    }
}

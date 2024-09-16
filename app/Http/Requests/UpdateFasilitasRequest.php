<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFasilitasRequest extends FormRequest
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
            'fasilitas_id' => [
                Rule::unique('fasilitas')->ignore($this->route('fasilitas')),
            ],
            'nama_fasilitas'=>['required','max:100'],
            'foto_fasilitas' => '|image|mimes:jpeg,png,jpg|max:2048',
            'status'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'nama_fasilitas.required' => 'Nama fasilitas wajib diisi.',
            'nama_fasilitas.max' => 'Nama fasilitas tidak boleh melebihi :max karakter.',
            'foto_fasilitas.image' => 'Foto fasilitas harus berupa file gambar.',
            'foto_fasilitas.mimes' => 'Format foto fasilitas harus jpeg, png, atau jpg.',
            'foto_fasilitas.max' => 'Ukuran foto fasilitas tidak boleh melebihi :max kilobita.',
            'status.required' => 'Status wajib diisi.',
        ];
    }
}

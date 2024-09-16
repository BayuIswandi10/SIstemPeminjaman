<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdatePenggunaRequest extends FormRequest
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
            'pengguna_id' => [
                Rule::unique('penggunas')->ignore($this->route('pengguna')),
            ],
            'nama'=>['required','max:100'],
            'alamat'=>['required'],
            'nohp'=>['required'],
            'foto' => '|image|mimes:jpeg,png,jpg|max:2048',
            'role'=>['required'],
            'main_job'=>['required'],
            'other_job'=>['required'],
            'status',
            'username',
            'password',
        ];  
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh melebihi :max karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nohp.required' => 'Nomor HP wajib diisi.',
            'foto.image' => 'Foto harus berupa file gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran foto tidak boleh melebihi :max kilobita.',
            'role.required' => 'Role wajib diisi.',
            'main_job.required' => 'Main Job wajib diisi.',
            'other_job.required' => 'Other Job wajib diisi.',
            // You can add more custom messages for other fields if needed
        ];
    }
}

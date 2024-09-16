<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSesiRequest extends FormRequest
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
            'sesi_id' => [
                Rule::unique('sesis')->ignore($this->route('sesi')),
            ],
            'nama_sesi'=>['required','max:100'],
            'sesi_awal'=>['required'],
            'sesi_akhir' => ['required'],        
        ];
    }

    public function messages()
    {
        return [
            'nama_sesi.required' => 'Nama sesi wajib diisi.',
            'nama_sesi.max' => 'Nama sesi tidak boleh melebihi :max karakter.',
            'sesi_awal.required' => 'Waktu awal sesi wajib diisi.',
            'sesi_akhir.required' => 'Waktu akhir sesi wajib diisi.',
            'sesi_akhir.unique' => 'Sesi Sudah Tersedia.',
            // You can add more custom messages for other fields if needed
        ];
    }
}

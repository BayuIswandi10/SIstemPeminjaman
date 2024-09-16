<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRuanganRequest extends FormRequest
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
            'ruangan_id' => [
                Rule::unique('ruangans')->ignore($this->route('ruangan')),
            ],
            'nama_ruangan'=>['required','max:100'],
            'lokasi_ruangan'=>['required'],
            'kapasitas_ruangan'=>['required'],
            'fasilitas_ids.*' => 'required|exists:fasilitas,fasilitas_id',
            'jumlah.*' => 'required|integer|min:1',
            'kondisi.*' => '',            
            'keterangan_ruangan' => ['required'],
            'koor_upt'=>['required'],
            'pic_lab'=>['required'],
            'admin_lab1'=>['required'],
            'admin_lab2'=>['required'],
            'status' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi.',
            'nama_ruangan.max' => 'Nama ruangan tidak boleh melebihi :max karakter.',
            'lokasi_ruangan.required' => 'Lokasi ruangan wajib diisi.',
            'kapasitas_ruangan.required' => 'Kapasitas ruangan wajib diisi.',
            'fasilitas_ids.*.required' => 'Fasilitas wajib dipilih.',
            'fasilitas_ids.*.exists' => 'Fasilitas yang dipilih tidak valid.',
            'jumlah.*.required' => 'Jumlah fasilitas wajib diisi.',
            'jumlah.*.integer' => 'Jumlah fasilitas harus berupa angka.',
            'jumlah.*.min' => 'Jumlah fasilitas minimal :min.',
            'keterangan_ruangan.required' => 'Keterangan ruangan wajib diisi.',
            'koor_upt.required' => 'Koordinator UPT wajib diisi.',
            'pic_lab.required' => 'PIC Lab wajib diisi.',
            'admin_lab1.required' => 'Admin Lab 1 wajib diisi.',
            'admin_lab2.required' => 'Admin Lab 2 wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            // You can add more custom messages for other fields if needed
        ];
    }
}

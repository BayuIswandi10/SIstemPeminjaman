<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarangRequest extends FormRequest
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
            'barang_id' => [
                Rule::unique('barangs')->ignore($this->route('barang')),
            ],
            'nama_barang'=>['required','max:100'],
            'nomor_aktiva'=>['required'],
            'tipe_barang'=>['required'],
            'stok'=>['required'],
            'satuan_barang'=>['required'],
            'keterangan_barang'=>['required'],
            'gambar_barang'=>'|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=412,max_height=369',
            'lokasi_barang'=>['required'],
            'baris_lokasi'=>['required'],
            'status'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.max' => 'Nama barang tidak boleh melebihi :max karakter.',
            'nomor_aktiva.required' => 'Nomor aktiva wajib diisi.',
            'nomor_aktiva.unique' => 'Nomor aktiva sudah digunakan.',
            'tipe_barang.required' => 'Tipe barang wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'satuan_barang.required' => 'Satuan barang wajib diisi.',
            'keterangan_barang.required' => 'Keterangan barang wajib diisi.',
            'gambar_barang.required' => 'Gambar barang wajib diunggah.',
            'gambar_barang.image' => 'Gambar barang harus berupa file gambar.',
            'gambar_barang.mimes' => 'Format gambar barang harus jpeg, png, atau jpg.',
            'gambar_barang.max' => 'Ukuran gambar barang tidak boleh melebihi :max kilobita.',
            'gambar_barang.dimensions' => 'Dimensi gambar barang maksimal :max_width x :max_height piksel.',
            'lokasi_barang.required' => 'Lokasi barang wajib diisi.',
            'baris_lokasi.required' => 'Baris lokasi wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ];
    }
}

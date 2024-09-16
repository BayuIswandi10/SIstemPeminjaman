<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRuanganRequest extends FormRequest
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
            'nama_ruangan' => ['required', 'max:100', Rule::unique('ruangans')],            
            'lokasi_ruangan'=>['required'],
            'kapasitas_ruangan'=>['required'],
            'fasilitas_ids.*' => 'required|exists:fasilitas,fasilitas_id',
            'jumlah.*' => 'required|integer|min:1',
            'kondisi.*' => 'required',
            'keterangan_ruangan' => ['required'],
            'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto3' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto4' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
            'nama_ruangan.unique' => 'Nama ruangan sudah digunakan.',
            'lokasi_ruangan.required' => 'Lokasi ruangan wajib diisi.',
            // Tambahkan pesan kustom untuk aturan validasi lainnya
            'kapasitas_ruangan.required' => 'Kapasitas ruangan wajib diisi.',
            'fasilitas_ids.*.required' => 'Fasilitas wajib dipilih.',
            'fasilitas_ids.*.exists' => 'Fasilitas yang dipilih tidak valid.',
            'jumlah.*.required' => 'Jumlah fasilitas wajib diisi.',
            'jumlah.*.integer' => 'Jumlah fasilitas harus berupa angka.',
            'jumlah.*.min' => 'Jumlah fasilitas minimal :min.',
            'keterangan_ruangan.required' => 'Keterangan ruangan wajib diisi.',
            'foto1.required' => 'Foto 1 wajib diunggah.',
            'foto1.image' => 'Foto 1 harus berupa file gambar.',
            'foto1.mimes' => 'Format foto 1 harus jpeg, png, atau jpg.',
            'foto1.max' => 'Ukuran foto 1 tidak boleh melebihi :max kilobita.',
            // Tambahkan pesan kustom untuk aturan validasi lainnya
            'koor_upt.required' => 'Koordinator UPT wajib diisi.',
            'pic_lab.required' => 'PIC Lab wajib diisi.',
            'admin_lab1.required' => 'Admin Lab 1 wajib diisi.',
            'admin_lab2.required' => 'Admin Lab 2 wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ];
    }
}
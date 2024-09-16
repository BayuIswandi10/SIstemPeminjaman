<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePeminjamanBarangRequest extends FormRequest
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
            'peminjaman_barang_id' => [
                Rule::unique('peminjaman_barangs')->ignore($this->route('riwayat_peminjaman_barang')),
            ],
            'no_pengajuan', // Perlu ditambahkan aturan validasi
            'barang_ids.*' => 'required|exists:barangs,barang_id',
            'jumlah.*' => 'required|integer|min:1',
            'nim_peminjaman' => ['required'],
            'nama_peminjam' => ['required'],
            'tanggal_pinjam',
            'sesi_id' => ['required'],
            'waktu_kembali',
            'keperluan' => ['required'],
            'status' => ['required'],
            'foto_sebelum' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_setelah' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePeminjamanBarangRequest extends FormRequest
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
            'barang_ids.*' => [
                'required',
                'exists:barangs,barang_id',
                Rule::unique('barang_peminjaman_barang', 'barang_id')
                    ->where(function ($query) {
                        $query->whereIn('peminjaman_barang_id', function ($subquery) {
                            $subquery->from('peminjaman_barangs')
                                ->select('peminjaman_barang_id')
                                   ->where('tanggal_pinjam', $this->input('tanggal_pinjam'))
                                ->where('sesi_id', $this->input('sesi_id'))
                                ->whereIn('status', ['Disetujui', 'Dipinjam']); // Tambahkan status yang diperbolehkan
                        });
                    })
            ],
            'jumlah.*' => 'required|integer|min:1',
            'no_pengajuan', // Tambahkan aturan validasi sesuai kebutuhan
            'nim_peminjaman' => ['required'],
            'nama_peminjam' => ['required'],
            'tanggal_pinjam' => [
                'required',
                'date',
                Rule::unique('peminjaman_barangs')->where(function ($query) {
                    return $query->where('tanggal_pinjam', $this->input('tanggal_pinjam'))
                        ->where('sesi_id', $this->input('sesi_id'))
                        ->whereIn('status', ['Disetujui', 'Dipinjam']);
                }),
            ],
            'sesi_id' => ['required'],
            'waktu_kembali',
            'keperluan' => ['required'],
            'status' => ['required'],
            'foto_sebelum' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_setelah' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
    
    

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'barang_ids.*.required' => 'Barang wajib dipilih.',
            'barang_ids.*.exists' => 'Barang yang dipilih tidak valid.',
            'jumlah.*.required' => 'Jumlah barang wajib diisi.',
            'jumlah.*.integer' => 'Jumlah barang harus berupa bilangan bulat.',
            'jumlah.*.min' => 'Jumlah barang minimal :min.',
            'no_pengajuan.required' => 'Nomor pengajuan wajib diisi.',
            'nim_peminjaman.required' => 'NIM peminjam wajib diisi.',
            'nama_peminjam.required' => 'Nama peminjam wajib diisi.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_pinjam.date' => 'Tanggal pinjam harus berupa tanggal yang valid.',
            'tanggal_pinjam.unique' => 'Barang sudah dipinjam pada tanggal dan sesi yang sama.',
            'sesi_id.required' => 'Sesi wajib dipilih.',
            'waktu_kembali.required' => 'Waktu kembali wajib diisi.',
            'keperluan.required' => 'Keperluan wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'foto_sebelum.image' => 'Foto sebelum harus berupa file gambar.',
            'foto_sebelum.mimes' => 'Format foto sebelum harus jpeg, png, atau jpg.',
            'foto_sebelum.max' => 'Ukuran foto sebelum tidak boleh melebihi :max kilobita.',
            'foto_setelah.image' => 'Foto setelah harus berupa file gambar.',
            'foto_setelah.mimes' => 'Format foto setelah harus jpeg, png, atau jpg.',
            'foto_setelah.max' => 'Ukuran foto setelah tidak boleh melebihi :max kilobita.',
        ];
    }
    
}

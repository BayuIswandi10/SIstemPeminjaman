<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePeminjamanRuanganRequest extends FormRequest
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
            'ruangan_id' => ['required'],
            'no_pengajuan',
            'nim_peminjaman' => ['required'],
            'nama_peminjam' => ['required'],
            'tanggal_pinjam' => [
                'required',
                'date',
                Rule::unique('peminjaman_ruangans')->where(function ($query) {
                    return $query
                        ->where('tanggal_pinjam', $this->tanggal_pinjam)
                        ->where('sesi_id', $this->sesi_id)
                        ->where(function ($query) {
                            $query->where('status', 'Disetujui')->orWhere('status', 'Dipinjam');
                        });
                })
            ],
            'sesi_id' => [
                'required',
                Rule::unique('peminjaman_ruangans')->where(function ($query) {
                    return $query
                        ->where('tanggal_pinjam', $this->tanggal_pinjam)
                        ->where('sesi_id', $this->sesi_id)
                        ->where(function ($query) {
                            $query->where('status', 'Disetujui')->orWhere('status', 'Dipinjam');
                        });
                })
            ],
            
            'jumlah_pengguna' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $ruangan = \App\Models\Ruangan::find($this->ruangan_id);

                    if ($ruangan && $value > $ruangan->kapasitas_ruangan) {
                        $fail('Kapasitas ruangan tidak mencukupi');
                    }
                },
            ], 
            'waktu_kembali',
            'keperluan' => ['required'],
            'pengguna_id', 
            'status' => ['required'],
            'foto_sebelum' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_setelah' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'ruangan_id.required' => 'Ruangan wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_pinjam.date' => 'Tanggal pinjam harus berupa tanggal yang valid.',
            'tanggal_pinjam.unique' => 'Ruangan sudah dipinjam pada tanggal dan sesi yang sama dengan status Disetujui.',
            'sesi_id.required' => 'Sesi wajib dipilih.',
            'sesi_id.unique' => 'Ruangan sudah dipinjam pada tanggal dan sesi yang sama dengan status Disetujui.',
            'jumlah_pengguna.required' => 'Jumlah pengguna wajib diisi.',
            'jumlah_pengguna.integer' => 'Jumlah pengguna harus berupa bilangan bulat.',
            'jumlah_pengguna.min' => 'Jumlah pengguna minimal :min.',
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

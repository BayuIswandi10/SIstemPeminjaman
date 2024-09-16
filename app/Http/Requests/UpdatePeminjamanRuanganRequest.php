<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePeminjamanRuanganRequest extends FormRequest
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
            'peminjaman_ruangan_id' => [
                Rule::unique('peminjaman_ruangans')->ignore($this->route('riwayat_peminjaman_ruangan')),
            ],
            'ruangan_id' => ['required'],
            'no_pengajuan', // Perlu ditambahkan aturan validasi
            'nim_peminjaman',
            'nama_peminjam',
            'tanggal_pinjam' => [
                'date',
                Rule::unique('peminjaman_ruangans')
                    ->where(function ($query) {
                        return $query
                            ->where('tanggal_pinjam', $this->tanggal_pinjam)
                            ->where('sesi_id', $this->sesi_id)
                            ->where('ruangan_id', $this->ruangan_id)
                            ->where('status', 'Disetujui');
                    })
                    ->ignore($this->route('riwayat_peminjaman_ruangan')),
            ],
            'sesi_id' => [
                'required',
                Rule::unique('peminjaman_ruangans')
                    ->where(function ($query) {
                        return $query
                            ->where('tanggal_pinjam', $this->tanggal_pinjam)
                            ->where('sesi_id', $this->sesi_id)
                            ->where('ruangan_id', $this->ruangan_id)
                            ->where('status', 'Disetujui');
                    })
                    ->ignore($this->route('riwayat_peminjaman_ruangan')),
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
            'tanggal_pinjam.unique' => 'Ruangan sudah dipinjam pada tanggal dan sesi yang sama dengan status Disetujui.',
            'sesi_id.unique' => 'Ruangan sudah dipinjam pada tanggal dan sesi yang sama dengan status Disetujui.',
        ];
    }
}

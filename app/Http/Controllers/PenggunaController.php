<?php

namespace App\Http\Controllers;


use App\Models\Pengguna;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;


class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = Pengguna::all();
        return view('pengguna.index',['pengguna'=>$pengguna]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenggunaRequest $request)
    {
        $params = $request->validated();

        // Check if the username already exists
        $existingUsername = Pengguna::where('username', $request->username)->first();
        if ($existingUsername) {
            return redirect()->back()->with('error', 'Username sudah ada.')->withInput();
        }

        $imageName = time() . '.' . $request->foto->extension();
        $uploadedImage = $request->foto->move(public_path('assets/foto/admin'), $imageName);
        $imagePath = 'assets/foto/admin/' . $imageName;

        if ($pengguna = Pengguna::create($params)) {
            $pengguna->foto = $imagePath;
            $pengguna->save();
            return redirect(route('pengguna.index'))->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.edit', ['pengguna' => $pengguna]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenggunaRequest $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $params = $request->validated();
        
        // Simpan gambar baru
        if ($request->hasFile('foto')) {
            $newImage = $request->file('foto');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/admin'), $imageName);
            $newImagePath = 'assets/foto/admin/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($pengguna->foto && File::exists(public_path($pengguna->foto))) {
                File::delete(public_path($pengguna->foto));
            }
    
            $params['foto'] = $newImagePath;
        }
    
        // Lakukan pembaruan data pengguna
        if ($pengguna->update($params)) {
            return redirect(route('pengguna.index'))->with('success', 'Data berhasil diubah!');
        } else {
            // Jika terjadi kesalahan saat pembaruan pengguna
            return back()->with('error', 'Failed to update pengguna.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
         $pengguna = Pengguna::find($id);
     
         if ($pengguna) {
             $pengguna->status = 'Tidak Aktif';
             $pengguna->save();
     
             return redirect()->route('pengguna.index')->with('success', 'Data ID ' . $id . ' berhasil dihapus!');
         }
     
         return redirect()->route('pengguna.index')->with('error', 'Data not found.');
     }
     
}

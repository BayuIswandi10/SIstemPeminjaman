<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index',['barang'=>$barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        $params = $request->validated();
        
        $imageName = time() . '.' . $request->gambar_barang->extension();
        $uploadedImage = $request->gambar_barang->move(public_path('assets/foto/Barang'), $imageName);
        $imagePath = 'assets/foto/Barang/' . $imageName;
        
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($barang = Barang::create($params)) {
            $barang->gambar_barang = $imagePath; // Atur atribut gambar_barang
            $barang->save(); // Simpan perubahan
            return redirect(route('barang.index'))->with('success', 'Data berhasil ditambahkan!');
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
        $barang = Barang::findOrFail($id);
        return view('barang.edit', ['barang' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('gambar_barang')) {
            $newImage = $request->file('gambar_barang');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/Barang'), $imageName);
            $newImagePath = 'assets/foto/Barang/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($barang->gambar_barang && File::exists(public_path($barang->gambar_barang))) {
                File::delete(public_path($barang->gambar_barang));
            }
    
            $params['gambar_barang'] = $newImagePath;
        }

        // Lakukan pembaruan data barang
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($barang->update($params)) {
            return redirect(route('barang.index'))->with('success', 'Data berhasil diubah!');
        } else {
            // Jika terjadi kesalahan saat pembaruan barang
            return back()->with('error', 'Failed to update barang.');
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
        $barang = Barang::find($id);
     
        if ($barang) {
            $barang->status = 'Tidak Tersedia';
            $barang->save();
    
            return redirect()->route('barang.index')->with('success', 'Data ID ' . $id . ' berhasil dihapus!');
        }
    
        return redirect()->route('barang.index')->with('error', 'Data not found.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFasilitasRequest;
use App\Http\Requests\UpdateFasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $fasilitas = Fasilitas::all();
        return view('fasilitas.index',['fasilitas'=>$fasilitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fasilitas.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFasilitasRequest $request)
    {
        $params = $request->validated();
        
        $imageName = time() . '.' . $request->foto_fasilitas->extension();
        $uploadedImage = $request->foto_fasilitas->move(public_path('assets/foto/fasilitas'), $imageName);
        $imagePath = 'assets/foto/fasilitas/' . $imageName;
        
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($fasilitas = Fasilitas::create($params)) {
            $fasilitas->foto_fasilitas = $imagePath;
            $fasilitas->save();
            return redirect(route('fasilitas.index'))->with('success', 'Data berhasil ditambahkan!');
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
        $fasilitas = Fasilitas::findOrFail($id);
        return view('fasilitas.edit', ['fasilitas' => $fasilitas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFasilitasRequest $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_fasilitas')) {
            $newImage = $request->file('foto_fasilitas');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/fasilitas'), $imageName);
            $newImagePath = 'assets/foto/fasilitas/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($fasilitas->foto_fasilitas && File::exists(public_path($fasilitas->foto_fasilitas))) {
                File::delete(public_path($fasilitas->foto_fasilitas));
            }
    
            $params['foto_fasilitas'] = $newImagePath;
        }

        // Lakukan pembaruan data fasilitas
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($fasilitas->update($params)) {
            return redirect(route('fasilitas.index'))->with('success', 'Data berhasil diubah!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Failed to update fasilitas.');
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
        $fasilitas = Fasilitas::find($id);

        if ($fasilitas) {
            $fasilitas->status = 'Tidak Aktif';
            $fasilitas->save();
    
            return redirect()->route('fasilitas.index')->with('success', 'Data ID ' . $id . ' berhasil dihapus!');
        }
    
        return redirect()->route('fasilitas.index')->with('error', 'Data tidak ditemukan.');
    }
}

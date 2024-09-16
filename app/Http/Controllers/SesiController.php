<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSesiRequest;
use App\Http\Requests\UpdateSesiRequest;
use App\Models\Sesi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sesi = Sesi::all(); 
        return view('sesi.index',['sesi'=>$sesi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sesi.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSesiRequest $request)
    {
        $params = $request->validated();    
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        $params['status'] = 'Aktif';
        if ($fasilitas = Sesi::create($params)) {
            return redirect(route('sesi.index'))->with('success', 'Data berhasil ditambahkan!');
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
        $sesi = Sesi::findOrFail($id);
        return view('sesi.edit', ['sesi' => $sesi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSesiRequest $request, $id)
    {
        $fasilitas = Sesi::findOrFail($id);
        $params = $request->validated();
    
        // Lakukan pembaruan data mahasiswa
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($fasilitas->update($params)) {
            return redirect(route('sesi.index'))->with('success', 'Data berhasil diubah!');
        } else {    
            return back()->with('error', 'Failed to update sesi.');
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
        $sesi = Sesi::find($id);

        if ($sesi) {
            $sesi->status = 'Tidak Aktif';
            $sesi->save();
    
            return redirect()->route('sesi.index')->with('success', 'Data ID ' . $id . ' berhasil dihapus!');
        }
    
        return redirect()->route('sesi.index')->with('error', 'Data not found.');
    }
}

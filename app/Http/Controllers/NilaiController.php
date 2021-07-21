<?php

namespace App\Http\Controllers;

use App\nilai;
use App\mahasiswa;
use App\matkul;
use Illuminate\Http\Request;

class nilaicontroller extends Controller
{
    public function index()
    {
        $nilai = nilai::with(['mahasiswa','matkul'])->get(); //select * from nama_table   
        return View('nilai.index', compact('nilai'));
    }

    public function create()
    {
         $mahasiswa = mahasiswa::all();
         $matkul = matkul::all();
         return view('nilai.create', compact('mahasiswa','matkul'));
    }

    public function store(Request $request)
    {
        
        nilai::create($request->all());
        alert()->success('Sukses Ya','Data Berhasil Disimpan.');
        return redirect()->route('nilai');
    }

    public function edit($id)
    {
        $mahasiswa = mahasiswa::all();
        $matkul = matkul::all();
        $nilai =nilai::find($id);
        return view('nilai.edit', compact('nilai','mahasiswa','matkul'));
    }

    public function update(Request $request, $id)
    {
        $nilai =nilai::find($id);  
        $nilai->update($request->all()); 
        toast('Oh Yeah Kita Berhasil Mengedit Data','success');
        return redirect()->route('nilai');
    }

    public function destroy($id)
    {
        $nilai =nilai::find($id);
        $nilai->delete();
        toast('Oh Yeah Kita Berhasil Menghapus Data','success');
        return redirect()->route('nilai');  
    }
}
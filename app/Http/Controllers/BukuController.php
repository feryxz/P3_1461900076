<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\JenisBuku;
use App\Models\RakBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = DB::table('rak_buku')
            ->join('buku', 'rak_buku.id_buku', '=', 'buku.id')
            ->join('jenis_buku', 'rak_buku.id_jenis_buku', '=', 'jenis_buku.id')
            ->get();
        return view('0076buku.index', [
            'buku' => $buku
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('0076buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buku = Buku::create([
            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun,
        ]);
        $idbuku = DB::getPdo()->lastInsertId();
        // $idbuku = Buku::getPdo()->lastInsertId();

        $buku = RakBuku::create([
            'id_buku' => $idbuku,
            'id_jenis_buku' => 1,
        ]);
        return redirect('buku')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $cari = $request->cari;

        $buku = DB::table('rak_buku')
            ->join('buku', 'rak_buku.id_buku', '=', 'buku.id')
            ->join('jenis_buku', 'rak_buku.id_jenis_buku', '=', 'jenis_buku.id')
            ->where('buku.judul', 'like', "%" . $cari . "%")
            ->paginate();

        // mengambil data dari table pegawai sesuai pencarian data

        // mengirim data pegawai ke view index
        return view('0076buku.cari', ['buku' => $buku]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findorfail($id);
        return view('0076buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $buku = [
            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun,
        ];

        Buku::whereId($id)->update($buku);
        return redirect('buku')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Buku::findorfail($id);
        $data->delete();
        return redirect('buku')->with('success', 'Data berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pengunjung = Pengunjung::get();
        return view('pengunjung.display', compact('pengunjung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pengunjung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'noTelp' => 'required|string|max:15',
            'email' => 'required|email|max:255', 
            'jenisKelamin' => 'required|string',
            'tanggalLahir' => 'required|date',
        ]);

        $pengunjung = new Pengunjung();
        $pengunjung->nama = $request->nama;
        $pengunjung->alamat = $request->alamat;
        $pengunjung->noTelp = $request->noTelp;
        $pengunjung->email = $request->email;
        $pengunjung->jenisKelamin = $request->jenisKelamin;
        $pengunjung->tanggalLahir = $request->tanggalLahir;
        $pengunjung->save();
        
        return redirect()->route('pengunjung.display')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $pengunjung = Pengunjung::find($id);
        return view('pengunjung.update', compact('pengunjung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $pengunjung = Pengunjung::find($id);

        //periksa apakah id yang dituju ada/tidak
        if (!$pengunjung) {
            return redirect()->route('pengunjung.display')->with('error', 'Data tidak ditemukan!');
        }

        $pengunjung->nama = $request->nama;
        $pengunjung->alamat = $request->alamat;
        $pengunjung->noTelp = $request->noTelp;
        $pengunjung->email = $request->email;
        $pengunjung->jenisKelamin = $request->jenisKelamin;
        $pengunjung->tanggalLahir = $request->tanggalLahir;
        $pengunjung->save();

        return redirect()->route('pengunjung.display')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengunjung = Pengunjung::find($id);

        //periksa apakah id yang dituju ada/tidak
        if (!$pengunjung) {
            return redirect()->route('pengunjung.display')->with('error', 'Data tidak ditemukan!');
        }

        $pengunjung->delete();

        return redirect()->route('pengunjung.display')->with('success', 'Data berhasil dihapus!');
    }


    public function getDataPengunjung(){
        // Contoh query untuk mendapatkan jumlah pengunjung per bulan
        $pengunjung = DB::table('pengunjungs')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $formattedData = [
            'labels' => $pengunjung->pluck('month')->map(function ($month) {
                return date('F', mktime(0, 0, 0, $month, 10)); 
            }),
            'data' => $pengunjung->pluck('count')
        ];

        return response()->json($formattedData);
    }
}

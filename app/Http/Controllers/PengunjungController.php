<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PengunjungController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengunjung::query();

        // Filter berdasarkan angkatan
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        // Filter berdasarkan jurusan
        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        // Filter berdasarkan tanggal (menggunakan kolom tanggal)
        if ($request->filled('tanggal')) {
            try {
                $date = Carbon::parse($request->tanggal)->format('Y-m-d');
                $query->whereDate('tanggal', $date);
            } catch (\Exception $e) {
                $query->whereDate('tanggal', $request->tanggal);
            }
        }

        // Enhanced search functionality
        if ($request->filled('search')) {
            $searchTerm = '%'.$request->search.'%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', $searchTerm)
                  ->orWhere('keluhan', 'like', $searchTerm)
                  ->orWhere('terapi', 'like', $searchTerm);
            });
        }

        $pengunjungs = $query->latest()->get();

        // Get distinct values for filter dropdowns
        $angkatans = Pengunjung::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        $jurusanList = Pengunjung::select('jurusan')->distinct()->orderBy('jurusan')->pluck('jurusan');
        $kelasList = Pengunjung::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

        return view('dashboard', compact('pengunjungs', 'angkatans', 'jurusanList', 'kelasList'));
    }

    public function create()
    {
        return view('pengunjung.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:10|in:10,11,12',
            'angkatan' => 'required|integer|min:2000|max:'.(date('Y')+1),
            'jurusan' => 'required|string|max:50|in:PPLG,TJKT,DKV,AKL,ANIMASI,ULP,MPLB,PM',
            'keluhan' => 'required|string',
            'terapi' => 'required|string|max:100',
            'tanggal' => 'required|date', // tambahkan validasi tanggal
        ]);

        Pengunjung::create($validated);

        return redirect()->route('dashboard')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($pengunjung)
    {
        $pengunjung = Pengunjung::findOrFail($pengunjung);
        return view('pengunjung.edit', compact('pengunjung'));
    }

    public function update(Request $request, $pengunjung)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:10|in:10,11,12',
            'angkatan' => 'required|integer|min:2000|max:'.(date('Y')+1),
            'jurusan' => 'required|string|max:50|in:PPLG,TJKT,DKV,AKL,ANIMASI,ULP,MPLB,PM',
            'keluhan' => 'required|string',
            'terapi' => 'required|string|max:100',
            'tanggal' => 'required|date', // tambahkan validasi tanggal
        ]);

        $pengunjung = Pengunjung::findOrFail($pengunjung);
        $pengunjung->update($validated);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($pengunjung)
    {
        $pengunjung = Pengunjung::findOrFail($pengunjung);
        $pengunjung->delete();
        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus.');
    }
}

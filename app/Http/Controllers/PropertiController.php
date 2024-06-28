<?php

namespace App\Http\Controllers;

use App\Models\FotoProperti;
use App\Models\KategoriProperti;
use App\Models\Properti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.properti.index', [
            'properti' => Properti::all()->load('kategori')->load('foto'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.properti.create', [
            'kategori' => KategoriProperti::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'foto' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $properti = Properti::create($data);

            foreach ($request->file('foto') as $foto) {
                $foto->store('public/properti');
                FotoProperti::create([
                    'foto' => $foto->hashName(),
                    'properti_id' => $properti->id,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan' . $e->getMessage());
        }

        return redirect()->route('properti.index')->with('success', 'Properti berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Properti $properti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('page.properti.edit', [
            'properti' => Properti::find($id),
            'kategori' => KategoriProperti::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
        ]);

        try {
            DB::beginTransaction();


            $properti = Properti::find($id);
            $properti->update($data);

            if ($request->file('foto')) {
                foreach ($request->file('foto') as $foto) {
                    $foto->store('public/properti');
                    FotoProperti::create([
                        'foto' => $foto->hashName(),
                        'properti_id' => $properti->id,
                    ]);
                }

            }

            if ($request->deleted_photos) {
                $deleted = explode(',', $request->deleted_photos);

                foreach ($deleted as $delete) {
                    $foto = FotoProperti::find($delete);
                    $foto->delete();
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan' . $e->getMessage());
        }


        return redirect()->route('properti.index')->with('success', 'Properti berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $properti = Properti::find($id);
        $properti->delete();

        $gambar = FotoProperti::where('properti_id', $id)->get();
        foreach ($gambar as $g) {
            $g->delete();
        }

        return redirect()->route('properti.index')->with('success', 'Properti berhasil dihapus');
    }

    public function set_banner($id)
    {
        $properti = FotoProperti::find($id);

        FotoProperti::where('properti_id', $properti->properti_id)->update([
            'is_banner' => false
        ]);

        $properti->update([
            'is_banner' => true
        ]);

        return redirect()->back()->with('success', 'Banner berhasil diubah');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FotoPembayaran;
use App\Models\Pembayaran;
use App\Models\Booking;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function store(Request $request, $id)
    {
        $data = $request->validate([
            'ktp' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'kk' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'rekening' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'npwp' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'alamat' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Save booking data
            $data['properti_id'] = $id;
            $data['user_id'] = auth()->id();

            $booking = Booking::create($data);

            // Handle file uploads and save file names to database
            $files = ['ktp', 'kk', 'rekening', 'npwp'];
            foreach ($files as $file) {
                if ($request->hasFile($file)) {
                    $uploadedFile = $request->file($file);
                    $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
                    $uploadedFile->storeAs('public/dokumen', $fileName);

                    // Save document record
                    $dokumen = Dokumen::create([
                        'file' => $fileName,
                        'booking_id' => $booking->id,
                        'jenis_dokumen' => $file, // Save the type of document
                    ]);
                }
                dd($dokumen);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('riwayat')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal_transfer' => 'required',
            'jumlah_transfer' => 'required'
        ]);

        $request->foto->store('public/bukti_transfer');

        $data['foto'] = $request->foto->hashName();
        $data['pembayaran_id'] = $id;

        FotoPembayaran::create($data);

        Booking::find($id)->update([
            'status' => 'pending'
        ]);

        return redirect()->route('riwayat')->with('success', 'Data berhasil disimpan');
    }

    public function index_admin()
    {
        return view('page.pembayaran.index', [
            'pembayaran' => Booking::all()
        ]);
    }

    public function update_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'catatan' => 'required'
        ]);

        try {
            DB::beginTransaction();
            if ($request->status == "approve") {
                $foto = FotoPembayaran::find($id);
                $foto->update([
                    'status' => 1,
                    'catatan' => $request->catatan
                ]);

                $pembayaran = Booking::find($foto->pembayaran_id);
                $jumlah_dibayar = $foto->jumlah_transfer + $pembayaran->jumlah_dibayar;
                $status = $jumlah_dibayar >= $pembayaran->properti->harga ? 'paid' : 'loan';
                $pembayaran->update([
                    'status' => $status,
                    'jumlah_dibayar' => $jumlah_dibayar
                ]);
            } else {
                $foto = FotoPembayaran::find($id);
                $foto->update([
                    'status' => 1,
                    'catatan' => $request->catatan
                ]);

                $pembayaran = Booking::find($foto->pembayaran_id);
                $pembayaran->update([
                    'status' => 'last_payment_decline',
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashbord.pembayaran')->with('error', 'Data gagal disimpan' . $e->getMessage());
        }

        return redirect()->route('dashbord.pembayaran')->with('Success', 'Data berhasil disimpan');
    }
}

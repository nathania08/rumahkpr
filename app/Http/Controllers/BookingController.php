<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Dokumen;
use App\Models\FotoPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        return view('page.pembayaran.index', [
            'pembayaran' => Booking::all()->load('dokumen')
        ]);
    }

    public function store(Request $request, $id)
    {
        $data = $request->validate([
            'ktp' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'kk' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'rekening' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'npwp' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'alamat' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:255',
            'gaji' => 'required|string',
            'jenis_pembayaran' => 'required|in:tabungan_mandiri,tabungan_lainnya',
            'janji_temu' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $data['user_id'] = auth()->id();
            $data['properti_id'] = $id;

            $booking = Booking::create($data);

            $files = [
                'ktp' => 'ktp',
                'kk' => 'kk',
                'rekening' => 'rekening',
                'npwp' => 'npwp'
            ];

            foreach ($files as $fileInputName => $tipeDokumen) {
                if ($request->hasFile($fileInputName)) {
                    $uploadedFile = $request->file($fileInputName);
                    $fileName = uniqid() . '_' . $uploadedFile->getClientOriginalName();
                    $uploadedFile->storeAs('public/dokumen', $fileName);

                    Dokumen::create([
                        'file' => $fileName,
                        'booking_id' => $booking->id,
                        'tipe_dokumen' => $tipeDokumen,
                    ]);
                }
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

    public function detail()
    {
        $booking = Booking::with('dokumen')->get();
        return view('page.detail.index', compact('booking'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FotoProperti;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\KategoriProperti;
use App\Models\Properti;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('page.akun-user.index', compact('users'));
    }

    public function perumahan($id)
    {
        return view('page.landing.perumahan.detail', [
            'perumahan' => KategoriProperti::all(),
            'selectedPerumahan' => KategoriProperti::find($id),
            'properti' => Properti::all(),
        ]);
    }

    public function detail(Request $request, $id)
    {
        $kpr = null;
        $table = [];
        $result = [];
        if ($request->jumlah_kredit && $request->jangka_waktu && $request->bunga) {
            $kpr = $request->validate([
                'jumlah_kredit' => 'required|numeric',
                'jangka_waktu' => 'required|numeric|min:1',
                'bunga' => 'required|numeric|min:0',
                'check' => 'required',
            ]);

            $kpr['jangka_waktu'] = $request->jangka_waktu * 12;


            if ($kpr['check'] == 'Flat') {
                $sisa_pinjaman = $request->jumlah_kredit;

                for ($i = 1; $i <= $kpr['jangka_waktu']; $i++) {
                    $result['pokok'] = $request->jumlah_kredit / $kpr['jangka_waktu'];
                    $sisa_pinjaman -= $result['pokok'];
                    $result['bunga'] = $request->jumlah_kredit * ($request->bunga / 100) / 12;
                    $result['angsuran'] = $result['pokok'] + $result['bunga'];


                    $table[] = [
                        "bulan" => $i,
                        "pokok" => $result['pokok'],
                        "bunga" => $result['bunga'],
                        "angsuran" => $result['angsuran'],
                        "sisa" => $sisa_pinjaman,
                        "result" => $result,
                    ];
                }
            }

            if ($kpr['check'] == 'Efektif') {
                $sisa_pinjaman = $request->jumlah_kredit;

                for ($i = 1; $i <= $kpr['jangka_waktu']; $i++) {
                    $result['pokok'] = $request->jumlah_kredit / $kpr['jangka_waktu'];
                    $result['bunga'] = $sisa_pinjaman * ($request->bunga / 100) / 12;
                    $result['angsuran'] = $result['pokok'] + $result['bunga'];
                    $sisa_pinjaman -= $result['pokok'];

                    $table[] = [
                        "bulan" => $i,
                        "pokok" => $result['pokok'],
                        "bunga" => $result['bunga'],
                        "angsuran" => $result['angsuran'],
                        "sisa" => $sisa_pinjaman,
                        "result" => $result,
                    ];
                }
            }

            if ($kpr['check'] == 'Anuitas') {
                $jumlah_kredit = $request->jumlah_kredit;
                $bunga_tahunan = $request->bunga;
                $bunga_bulanan = $bunga_tahunan / 100 / 12;
                $jangka_waktu = $kpr['jangka_waktu'];
                $angsuran_bulanan = $jumlah_kredit * ($bunga_bulanan * pow(1 + $bunga_bulanan, $jangka_waktu)) / (pow(1 + $bunga_bulanan, $jangka_waktu) - 1);
                $sisa_pinjaman = $jumlah_kredit;

                for ($i = 1; $i <= $jangka_waktu; $i++) {
                    $bunga = $sisa_pinjaman * $bunga_bulanan;
                    $pokok = $angsuran_bulanan - $bunga;
                    $sisa_pinjaman -= $pokok;

                    $table[] = [
                        "bulan" => $i,
                        "pokok" => $pokok,
                        "bunga" => $bunga,
                        "angsuran" => $angsuran_bulanan,
                        "sisa" => $sisa_pinjaman > 0 ? $sisa_pinjaman : 0,
                    ];
                }
            }

        }


        return view('page.landing.detail.index', [
            'kpr' => $kpr,
            'perumahan' => KategoriProperti::all(),
            'properti' => Properti::find($id)->load('foto'),
            'id' => $id,
            'table' => $table,
            "result" => $result,
        ]);
    }

    public function booking($id)
    {
        return view('page.landing.booking.index', [
            'perumahan' => KategoriProperti::all(),
            'id' => $id,
        ]);
    }

    public function detail_booking($id)
    {
        $pembayaran = Booking::find($id);
        return view('page.landing.detail_booking.index', [
            'perumahan' => KategoriProperti::all(),
            'pembayaran' => $pembayaran,
        ]);
    }

    public function riwayat()
    {
        $pembayaran = Booking::where('user_id', Auth::user()->id)->with('dokumen')->get();
        if ($pembayaran->isEmpty()) {
            return redirect()->route('landing');
        }
        return view('page.landing.riwayat.index', [
            'pembayaran' => $pembayaran,
            'perumahan' => KategoriProperti::all(),
        ]);
    }

    public function checkout($id)
    {
        $pembayaran = Booking::find($id);

        if (!$pembayaran) {
            return redirect()->route('landing');
        }

        $date = Carbon::now()->toDateTimeString();
        return view('page.landing.pembayaran.index', [
            'pembayaran' => $pembayaran,
            'date' => $date,
            'perumahan' => KategoriProperti::all(),
        ]);
    }

    public function akun()
    {
        return view('page.landing.akun.index', [
            'perumahan' => KategoriProperti::all(),
            'user' => Auth::user(),
        ]);
    }

    public function kpr(Request $request, $id)
    {
        $kpr = $request->validate([
            'jumlah_kredit' => 'required|numeric',
            'jangka_waktu' => 'required|numeric|min:1',
            'bunga' => 'required|numeric|min:0',

        ]);



        return view('page.landing.detail.index', [
            'kpr' => $kpr,
            'perumahan' => KategoriProperti::all(),
            'properti' => Properti::find($id)->load('foto'),

        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KategoriProperti;
use App\Models\Properti;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        return view('page.landing.index', [
            'perumahan' => KategoriProperti::all(),
            'new_properti' => Properti::orderBy('created_at', 'desc')->limit(3)->get()
        ]);
    }

    public function dashboard()
    {
        return view('index', [
            'total_user' => User::where('role', 'user')->count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_properti' => Properti::count(),
            'total_kategori' => KategoriProperti::count(),
            'total_booking' => Booking::count(),
            'total_pembayaran' => Booking::where('status', 'success')->count(),
            'total_pending' => Booking::where('status', 'pending')->count(),
        ]);
    }


}

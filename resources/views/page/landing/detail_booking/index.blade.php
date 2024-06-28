@extends('layout.landing')

@section('content')
    <section class="background-section" style="height: 50vh" class="text-center">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Detail Booking</h1>
        </div>
    </section>

    <section>
        <div class="container my-5">
            <div class="card">
                <div class="card-header">
                    Detail Transaksi
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <td>{{ $pembayaran->user->name }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $pembayaran->user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">No. KTP/SIM/PASPOR</th>
                                    <td>{{ $pembayaran->no_identitas }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Telepon</th>
                                    <td>{{ $pembayaran->user->phone }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>{{ $pembayaran->alamat }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Waktu DP</th>
                                    <td>{{ $pembayaran->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Pembayaran</th>
                                    <td>{{ $pembayaran->jenis_pembayaran == 'tabungan_mandiri' ? 'Tabungan Mandiri' : 'Tabungan Lainnya' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Janji Temu</th>
                                    <td>{{ $pembayaran->janji_temu }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

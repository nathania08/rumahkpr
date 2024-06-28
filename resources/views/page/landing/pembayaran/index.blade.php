@extends('layout.landing')

@section('content')
    <style>
        .background-section {
            height: 50vh;
        }
    </style>
    <section class="background-section" class="text-center">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Pembayaran</h1>
        </div>
    </section>

    <section>
        <div class="container my-5">
            <div class="row">
                <div class="table-responsive">
                    <table class="table-bordered w-100">
                        <thead>
                            <tr>
                                <th scope="col">Perumahan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Sisa Bayar</th>
                                <th scope="col">Tanggal Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $pembayaran->properti->judul }}</td>
                                <td>Rp{{ number_format($pembayaran->properti->harga, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($pembayaran->properti->harga - $pembayaran->jumlah_dibayar, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($pembayaran->created_at)->format('d F Y') }}

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row form-container">
                <div class="col-md-4 d-flex justify-content-center img-box">
                    <img src="{{ asset('assets/image/payment.png') }}" alt="Placeholder Image" class="img-fluid">
                </div>
                <div class="col-md-8 d-flex justify-content-start">
                    <div class="form-box w-100">
                        <h3 class="text-center mb-4">Formulir Transfer</h3>
                        <p class="fs-5 fw-bold">No. Rek : 123456789(BCA, Atas nama : PT ...)</p>
                        <form method="POST" action="{{ route('checkout.update', $pembayaran->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" value="{{ $pembayaran->nama }}" id="nama"
                                    placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggalTransfer">Tanggal Transfer</label>
                                <input type="date" class="form-control" name="tanggal_transfer"
                                    value="{{ $date = date('Y-m-d', time()) }}" id="tanggalTransfer" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="fotoBukti">Foto Bukti</label>
                                <input type="file" class="form-control" name="foto" id="fotoBukti" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jumlahTransfer">Jumlah Transfer</label>
                                <input type="number" class="form-control" name="jumlah_transfer" id="jumlahTransfer"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

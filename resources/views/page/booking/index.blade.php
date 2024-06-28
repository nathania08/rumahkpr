@extends('layout.dashboard')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h3><strong>Data Booking</strong></h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Daftar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah dibayarkan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Janji Temu</th>
                        <th scope="col">Jenis Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->properti->judul }}</td>
                            <td>Rp{{ number_format($item->properti->harga, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->jumlah_dibayar, 0, ',', '.') }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->janji_temu }}</td>
                            <td>{{ $item->jenis_pembayaran }}</td>
                            <td>
                                @if ($item->status == 'unpaid')
                                    Belum Dibayar
                                @elseif($item->status == 'loan')
                                    Masih dalam cicilan
                                @elseif($item->status == 'paid')
                                    Lunas
                                @elseif($item->status == 'last_payment_decline')
                                    Bukti pembayaran ditolak
                                @else
                                    Dalam review admin
                                @endif

                            </td>
                            <td>
                                <a href="{{ route('detail_booking', $item->id) }}" class="btn btn-primary">Detail</a>
                                @if ($item->file->isEmpty())
                                    <a href="{{ route('pembayaran', $item->id) }}" class="btn btn-dark">Silahkan Upload
                                        Bukti Pembayaran</a>
                                @else
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#buktiTransfer-{{ $item->id }}">
                                        Lihat bukti bayar
                                    </button>
                                @endif
                            </td>

                        </tr>
                        <div class="modal fade" id="buktiTransfer-{{ $item->id }}" tabindex="-1"
                            aria-labelledby="buktiTransfer-{{ $item->id }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="buktiTransfer-{{ $item->id }}Label">
                                            Bukti pembayaran
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($item->file as $key => $file)
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <img src="{{ asset('storage/bukti_transfer/' . $file->file) }}"
                                                        alt="" class="img-fluid">
                                                </div>
                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Konfirmasi Pembayaran</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <h4>Tanggal Transfer : </h4>
                                                                <h4>{{ $foto->tanggal_transfer }}</h4>
                                                            </div>
                                                            <div class="d-flex">
                                                                <h4>Jumlah Transfer : </h4>
                                                                <h4>{{ $foto->jumlah_transfer }}</h4>
                                                            </div>
                                                            <div class="d-flex">
                                                                <h4>Catatan : </h4>
                                                                <h4>{{ $foto->catatan }}</h4>
                                                            </div>
                                                            @if (!$foto->status)
                                                                <form
                                                                    action="{{ route('dashbord.update_status', $foto->id) }}"
                                                                    method="post" class="form-group">
                                                                    @csrf
                                                                    <div class="form-group mb-2">
                                                                        <label for="catatan">Catatan</label>
                                                                        <input type="text" name="catatan" id="catatan"
                                                                            class="form-control" required>
                                                                    </div>
                                                                    <button class="btn btn-success" name="status"
                                                                        value="approve">Terima</button>
                                                                    <button class="btn btn-danger" name="status"
                                                                        value="decline">Tolak</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

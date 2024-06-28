@extends('layout.dashboard')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h3><strong>Detail Booking</strong></h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No. Identitas</th>
                        <th scope="col">Pekerjaan</th>
                        <th scope="col">Gaji</th>
                        <th scope="col">Dokumen</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis Pembayaran</th>
                        <th scope="col">Janji Temu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_identitas }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->gaji }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#dokumen-{{ $item->id }}">
                                    Detail
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="dokumen-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Dokumen</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($item->dokumen->isNotEmpty())
                                                    <div class="row">
                                                        @foreach ($item->dokumen as $file)
                                                            <div class="col-md-6 mb-4">
                                                                <div class="card shadow-sm">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">{{ $file->tipe_dokumen }}
                                                                        </h5>
                                                                        @php
                                                                            $filePath =
                                                                                'storage/dokumen/' . $file->file;
                                                                        @endphp

                                                                        @if (file_exists(public_path($filePath)))
                                                                            <img src="{{ asset($filePath) }}"
                                                                                alt="Image for {{ $file->tipe_dokumen }}"
                                                                                class="img-fluid rounded">
                                                                        @else
                                                                            <p class="text-danger">File not found:
                                                                                {{ $filePath }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-muted text-center">No files available.</p>
                                                @endif
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->jenis_pembayaran }}</td>
                            <td>{{ $item->janji_temu }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

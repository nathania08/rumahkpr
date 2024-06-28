@extends('layout.dashboard')
@php
    use Illuminate\Support\Str;
@endphp
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3><strong>Properti</strong></h3>
                <a href="{{ route('properti.create') }}" class="btn btn-primary">Tambah Properti</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properti as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori->nama }}</td>
                            <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail-{{ $key }}">
                                    Lihat detail
                                </button>
                                <a href="{{ route('properti.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('properti.destroy', $item->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                            <div class="modal fade" id="modalDetail-{{ $key }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $item->judul }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Deskripsi:</strong></p>
                                            <p>{!! $item->deskripsi !!}</p>

                                            <div class="row">
                                                @foreach ($item->foto as $key => $foto)
                                                    <div class="col-6">
                                                        <img src="{{ asset('storage/properti/' . $foto->foto) }}"
                                                            alt="Foto Properti" class="img-fluid">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

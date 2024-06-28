@extends('layout.dashboard')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3><strong>Buat Kategori Properti Baru</strong></h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="post" class="form-group">
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" value="{{ $kategori->nama }}" class="form-control"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required>
                        {{ $kategori->deskripsi }}
                    </textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" value="{{ $kategori->alamat }}" id="alamat" class="form-control"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@extends('layout.dashboard')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3><strong>Buat Kategori Properti Baru</strong></h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('kategori.store') }}" method="post" class="form-group">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

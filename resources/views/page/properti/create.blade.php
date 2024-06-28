@extends('layout.dashboard')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3><strong>Buat Properti Baru</strong></h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('properti.store') }}" method="post" class="form-group" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="judul">Nama Properti</label>
                    <input type="text" name="judul" id="judul" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="hidden" name="deskripsi" id="deskripsi" class="form-control" required>
                    <trix-editor input="deskripsi"></trix-editor>
                </div>
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="foto">Foto</label>
                        <div class="tambah-foto">Tambah Foto</div>
                    </div>
                    <div id="photos">
                        <input type="file" name="foto[1]" id="foto[1]" class="form-control mt-2" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select">
                        <option>Pilih...</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let count = 1
            $('.tambah-foto').click(function() {
                count++
                $('#photos').append(`
                    <input type="file" name="foto[${count}]" id="foto[${count}]" class="form-control mt-2" required>
                `)
            })
        })
    </script>
@endsection

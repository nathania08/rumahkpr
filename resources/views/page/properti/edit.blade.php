@extends('layout.dashboard')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3><strong>Edit Properti</strong></h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('properti.update', $properti->id) }}" method="post" class="form-group"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="judul">Nama Properti</label>
                    <input type="text" name="judul" id="judul" value="{{ $properti->judul }}" class="form-control"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="hidden" name="deskripsi" id="deskripsi" value="{{ $properti->deskripsi }}"
                        class="form-control" required>
                    <trix-editor input="deskripsi"></trix-editor>
                </div>
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="foto">Foto</label>
                        <div class="tambah-foto">Tambah Foto</div>
                    </div>
                    <div class="row" id="exiting-photos">
                        @foreach ($properti->foto as $key => $foto)
                            <div class="col-4 mt-2 d-flex align-items-center">
                                <img width="300" class="" src="{{ asset('storage/properti/' . $foto->foto) }}"
                                    alt="Foto Properti">
                                <div class="">
                                    <button id="{{ $foto->id }}" class="btn btn-warning ms-3">Hapus</button>
                                    @if ($foto->is_banner)
                                        <a class="btn btn-success ms-3 mt-2">Gambar Banner</a>
                                    @else
                                        <a href="{{ route('kategori.set_banner', $foto->id) }}"
                                            class="btn btn-info ms-3 mt-2">Jadikan Banner</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="photos">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select">
                        <option value="">Pilih...</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $properti->kategori_id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="deleted_photos" value="" id="deleted-photos">

                <div class="form-group mb-3">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" value="{{ $properti->harga }}" class="form-control"
                        required>
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

            let deletedPhotos = []

            $('#exiting-photos').on('click', 'button', function() {
                const id = $(this).attr('id')
                deletedPhotos.push(id)
                $(this).parent().remove()
                $('#deleted-photos').val(deletedPhotos)
            })
        })
    </script>
@endsection

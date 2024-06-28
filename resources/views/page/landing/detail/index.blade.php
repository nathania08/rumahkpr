@extends('layout.landing')

@section('content')
    <style>
        .bg-section {
            background-image: url('{{ asset('/storage/properti/' . $properti?->foto[0]?->foto) }}');
            background-size: cover;
            background-position: center;
            height: 50vh;
            display: flex;
            align-items: end;
            justify-content: center;
            color: #fff;
        }
    </style>
    <section class="bg-section" class="text-center d-flex">
    </section>

    <section id="new" class="text-dark py-5">
        <h1 class="display-4 fw-bold m-2 text-center">{{ $properti->judul }}</h1>
        <div class="container mt-5">
            <div class="justify-content-center">
                <section class="splide" aria-label="Splide Basic HTML Example">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($properti->foto as $foto)
                                <li class="splide__slide px-2">
                                    <img src="{{ asset('/storage/properti/' . $foto->foto) }}" class="img-fluid"
                                        alt="Rumah KPR">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <div class="mt-3">
                    <p class="text-center fs-5">{{ $properti->kategori->nama }}</p>
                    <p class="text-center fs-5">Rp{{ number_format($properti->harga, 0, ',', '.') }}</p>
                    <p class="text-center fs-5">{{ $properti->kategori->deskripsi }}</p>

                </div>
            </div>
        </div>
        </div>
        <div class="container mt-3">
            <div class="row justify-content-center mt-3">
                <div class="col-12">
                    <a href="{{ route('checkout', $properti->id) }}" class="btn btn-primary w-100 h-100 fs-3">Booking</a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container mb-3">
            <div class="text-center">
                <p class="fs-1">
                    Form Simulasi KPR
                </p>
            </div>
            <form method="GET" action="">
                <div class="mb-3">
                    <label class="form-label">Jumlah Kredit (rupiah)</label>
                    <input type="number" class="form-control" name="jumlah_kredit" value="{{ $properti->harga }}"
                        id="" aria-describedby="" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jangka Waktu (Tenor)</label>
                    <select name="jangka_waktu" id="waktu" class="form-select">
                        <option selected hidden>Silahlan pilih..</option>
                        <option value="10" @if (@$_GET['jangka_waktu'] == '10') selected @endif>10 Tahun</option>
                        <option value="15" @if (@$_GET['jangka_waktu'] == '15') selected @endif>15 Tahun</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bunga Pertahun (%)</label>
                    <input type="number" class="form-control" name="bunga" readonly id="bunga"
                        value="{{ @$_GET['bunga'] }}">
                </div>
                <div class="mb-3 form-check">
                    <input type="radio" class="form-check-input" id="Flat" value="Flat"
                        @if (@$_GET['check'] == 'Flat') checked @endif name="check">
                    <label class="form-check-label" for="Flat">Flat</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="radio" class="form-check-input" id="Efektif" value="Efektif"
                        @if (@$_GET['check'] == 'Efektif') checked @endif name="check">
                    <label class="form-check-label" for="Efektif">Efektif</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="radio" class="form-check-input" id="Anuitas" value="Anuitas"
                        @if (@$_GET['check'] == 'Anuitas') checked @endif name="check">
                    <label class="form-check-label" for="Anuitas">Anuitas</label>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Hitung</button>
                    <a href={{ route('detail', $id) }} class="btn btn-warning">Ulangi</a>
                </div>
            </form>
        </div>
    </section>

    @if ($kpr)
        <div class="container my-5">
            <div class="text-center mb-5">
                <p class="fs-1">
                    Hasil Simulasi KPR
                </p>
            </div>
            <div class="mt-4">
                <div class="row mb-2">
                    <div class="col-6 d-flex justify-content-between">
                        <div>Total Pinjaman</div>
                        <div class="colon">
                            :
                        </div>
                    </div>
                    <div class="col-6">Rp{{ number_format($kpr['jumlah_kredit'], 0, ',', '.') }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 d-flex justify-content-between">
                        <div>Lama Pinjaman</div>
                        <div class="colon">:</div>
                    </div>
                    <div class="col-6">{{ $kpr['jangka_waktu'] }} Tahun</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 d-flex justify-content-between">
                        <div>Bunga Pertahun</div>
                        <div class="colon">:</div>
                    </div>
                    <div class="col-6">{{ $kpr['bunga'] }}%</div>
                </div>
                @if ($kpr['check'] == 'Flat')
                    <div class="row mb-2">
                        <div class="col-6 d-flex justify-content-between">
                            <div>Angsuran Pokok Perbulan</div>
                            <div class="colon">:</div>
                        </div>
                        <div class="col-6">Rp{{ number_format(@$result['pokok'], 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 d-flex justify-content-between">
                            <div>Angsuran Bunga Perbulan</div>
                            <div class="colon">:</div>
                        </div>
                        <div class="col-6">Rp{{ number_format(@$result['bunga'], 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 d-flex justify-content-between">
                            <div>Total Angsuran Perbulan</div>
                            <div class="colon">:</div>
                        </div>
                        <div class="col-6">Rp{{ number_format(@$result['angsuran'], 0, ',', '.') }}</div>
                    </div>
                @endif
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Bulan</th>
                            <th scope="col">Pokok</th>
                            <th scope="col">Bunga</th>
                            <th scope="col">Angsuran</th>
                            <th scope="col">Sisa Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($table as $item)
                            <tr>
                                <td>Bulan ke {{ $item['bulan'] }}</td>
                                <td>Rp{{ number_format($item['pokok'], '0', ',', '.') }}</td>
                                <td>Rp{{ number_format($item['bunga'], '0', ',', '.') }}</td>
                                <td>Rp{{ number_format($item['angsuran'], '0', ',', '.') }}</td>
                                <td>Rp{{ number_format($item['sisa'], '0', ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var waktu = document.getElementById('waktu');
            var bunga = document.getElementById('bunga');
            var check = document.getElementsByName('check');
            var jumlah_kredit = document.getElementsByName('jumlah_kredit')[0].value;
            var bunga_pertahun = 0;

            waktu.addEventListener('change', function() {
                if (waktu.value == 10) {
                    bunga_pertahun = 8.88;
                } else if (waktu.value == 15) {
                    bunga_pertahun = 7.5;
                }
                bunga.value = bunga_pertahun;
            });
        });
    </script>
@endsection

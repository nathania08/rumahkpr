@extends('layout.landing')

@section('content')
    <section id="home" class="bg-light text-dark py-2">
        <div class="container-landing">
            <div class="row align-items-center g-10">
                <div class="col-lg-6">
                    <p class="fs-1 fw-bold">KPR Mandiri</p>
                    <p class="fs-6">
                        KPR Mandiri adalah solusi ideal bagi kamu yang ingin membeli properti dengan
                        cicilan yang ringan. Melalui produk pembiayaan dari Bank Mandiri ini, kamu dapat mewujudkan impian
                        memiliki rumah, apartemen, atau ruko tanpa harus membebani kondisi finansial. KPR Mandiri
                        menawarkan berbagai kemudahan dan fleksibilitas, sehingga proses pembelian properti menjadi
                        lebih terjangkau dan nyaman. Dengan KPR Mandiri, kamu bisa merencanakan masa depan dengan
                        lebih tenang dan percaya diri, karena memiliki hunian idaman kini bukan lagi sekadar impian,
                        melainkan sebuah kenyataan yang bisa diwujudkan dengan langkah-langkah yang tepat</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/image/tenera/GAPURA KOMPLEK.jpg') }}" class="img-fluid" alt="Rumah KPR"
                        style="width: 600px; height: 500px;">
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="bg-body-tertiary text-dark py-2">
        <div class="container-landing py-3">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('assets/image/tenera/HALAMAN DEPAN (3).png') }}" class="img-fluid" alt="Rumah KPR">
                </div>
                <div class="col-lg-6">
                    <p class="fs-1 fw-bold"><strong>ABOUT US</strong></p>
                    <p class="">PT. HARMONY LAND GROUP</p>
                    <p>To be Trusted Developer for First Home Buyer that Deliver High Investment Value Project by
                        Concern to Quality and Design with promoting the Harmony Madani Living</p>

                    <p class="fs-1 fw-bold"><strong>COMPANY VALUE</strong></p>
                    <p>
                        <strong>THE FIRST</strong> adalah dasar tindakan kita dalam merespon setiap kondisi yang terjadi
                        dalam
                        rangka mendengar, mendukung dan membantu perjuangan para Pahlawan Keluarga.
                        Sebagai Seorang Harmonians yang memiliki jiwa Caregiver, Kita sangat perlu cekatan dalam
                        setiap tindakan kita. Dimana kita selalu menjadi yang pertama melakukan aksi nyata, selalu
                        menjadi yang pertama melakukan perbaikan, dan selalu menjadi yang pertama dalam mendapatkan
                        hasil yang kongkrit. Dimana semua itu hanya memiliki satu tujuan, yaitu mendukung para
                        Pahlawan Keluarga mencapai impian terbesarnya, yaitu memberikan yang terbaik bagi keluarga
                        tercint
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="new" class="bg-body-tertiary text-dark py-2">
        <div class="container-landing pt-3">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <p class="lead fs-1 fw-bold">Properti Terbaru</p>
                </div>
            </div>
            <div class="row">
                @foreach ($new_properti as $perum)
                    <a href="{{ route('detail', ['id' => $perum->id]) }}"
                        class="text-decoration-none text-dark col-lg-6 mb-4">
                        <div class="overflow-hidden">
                            <div class="overflow-hidden">
                                <img src="{{ asset('/storage/properti/' . $perum->banner->foto) }}" class="img-fluid w-100"
                                    alt="Rumah KPR">
                            </div>
                            <div class="row d-flex align-items-center mt-3 perumDetailCard">
                                <div class="col-lg-6">
                                    <p class="lead fs-3 fw-semibold">{{ $perum->judul }}</p>
                                    <p class="lead fs-5">{!! $perum->deskripsi !!}</p>
                                    <p class="lead fs-5">Rp. {{ number_format($perum->harga, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-lg-6">
                                    <div id="carouselExampleIndicators-{{ $perum->id }}" class="carousel slide"
                                        data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            @foreach ($perum->foto as $index => $foto)
                                                <button type="button"
                                                    data-bs-target="#carouselExampleIndicators-{{ $perum->id }}"
                                                    data-bs-slide-to="{{ $index }}"
                                                    class="{{ $index === 0 ? 'active' : '' }}"
                                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                                    aria-label="Slide {{ $index + 1 }}"></button>
                                            @endforeach
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach ($perum->foto as $index => $foto)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('/storage/properti/' . $foto->foto) }}"
                                                        class="img-fluid w-100" alt="Rumah KPR">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleIndicators-{{ $perum->id }}"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleIndicators-{{ $perum->id }}"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection

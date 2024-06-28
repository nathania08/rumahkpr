@extends('layout.landing')

@section('content')
    <section class="background-section" class="text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">{{ $selectedPerumahan->nama }}</h1>
        </div>
    </section>

    <section id="new" class="text-dark py-5">
        <div class="container">
            <div class="row g-5">
                @foreach ($properti as $item)
                    <a class="col-lg-6 text-decoration-none text-black" href="{{ route('detail', $item->id) }}">
                        @if ($item->foto && $item->foto->count() > 0)
                            <img src="{{ asset('/storage/properti/' . $item->foto[0]->foto) }}" class="img-fluid"
                                alt="Rumah KPR">
                        @else
                            <img src="https://th.bing.com/th/id/OIP.2DZi9rihdeyczK6N3KmGYgAAAA?rs=1&pid=ImgDetMain"
                                alt="">
                        @endif
                        <p class="fs-3 fw-semibold mt-3">{{ $item->judul }}</p>
                        <p class="fs-5">{!! $item->deskripsi !!}</p>
                        <p class="fs-5">{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@extends('layout.landing')

@section('content')
    <section class="background-section" style="height: 50vh" class="text-center">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Detail Akun</h1>
        </div>
    </section>

    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                Akun
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Lengkap</th>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">phone</th>
                                <td>{{ Auth::user()->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

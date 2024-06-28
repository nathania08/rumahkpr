@extends('layout.dashboard')

@section('content')
    <div class="row mt-3">
        <div class="col-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Total User</h4>
                    <h4>{{ $total_user }}</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Total Admin</h4>
                    <h4>{{ $total_admin }}</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Total Properti</h4>
                    <h4>{{ $total_properti }}</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Total Kategori</h4>
                    <h4>{{ $total_kategori }}</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Total Booking</h4>
                    <h4>{{ $total_booking }}</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Total Pembayaran</h4>
                    <h4>{{ $total_pembayaran }}</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4>Total Pending</h4>
                    <h4>{{ $total_pending }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection

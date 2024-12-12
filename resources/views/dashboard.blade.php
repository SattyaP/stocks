@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold">Dashboard</h2>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-decoration-underline"><a
                                href="{{ route('barang.list') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">#</li>
                    </ol>
                </nav>
            </div>

            <div class="bg-secondary text-white p-2 rounded d-flex gap-2 align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path fill="#fff"
                        d="M5.673 0a.7.7 0 0 1 .7.7v1.309h7.517v-1.3a.7.7 0 0 1 1.4 0v1.3H18a2 2 0 0 1 2 1.999v13.993A2 2 0 0 1 18 20H2a2 2 0 0 1-2-1.999V4.008a2 2 0 0 1 2-1.999h2.973V.699a.7.7 0 0 1 .7-.699M1.4 7.742v10.259a.6.6 0 0 0 .6.6h16a.6.6 0 0 0 .6-.6V7.756zm5.267 6.877v1.666H5v-1.666zm4.166 0v1.666H9.167v-1.666zm4.167 0v1.666h-1.667v-1.666zm-8.333-3.977v1.666H5v-1.666zm4.166 0v1.666H9.167v-1.666zm4.167 0v1.666h-1.667v-1.666zM4.973 3.408H2a.6.6 0 0 0-.6.6v2.335l17.2.014V4.008a.6.6 0 0 0-.6-.6h-2.71v.929a.7.7 0 0 1-1.4 0v-.929H6.373v.92a.7.7 0 0 1-1.4 0z" />
                </svg>
                <span>{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Barang</h5>
                        <p class="card-text">Total Barang: {{ $barang }}</p>
                        <a href="{{ route('barang.index') }}" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Supplier</h5>
                        <p class="card-text">Total Supplier: {{ $supplier }}</p>
                        <a href="{{ route('supplier.index') }}" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Total Barang Digudang</h5>
                        <p class="card-text">Total Barang Digudang:</p>
                        <span class="fs-2">{{ $totalBarang }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Total Invest</h5>
                        <p class="card-text">Total Harga Keseluruhan: </p>
                        <span class="fs-2">Rp.{{ number_format($totalHarga, 0, ',', '.') }}.-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

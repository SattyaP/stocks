@extends('layouts.app')

@section('title', 'List Barang')

@section('content')
    <div class="container">
        <div class="d-flex">
            <div>
                <h2 class="fw-bold">List Barang</h2>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-decoration-underline"><a href="{{ route('barang.list') }}">Manajemen
                                Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Barang</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="bg-secondary text-white p-2 rounded d-flex gap-2 align-items-center"><svg
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <path fill="#fff"
                            d="M5.673 0a.7.7 0 0 1 .7.7v1.309h7.517v-1.3a.7.7 0 0 1 1.4 0v1.3H18a2 2 0 0 1 2 1.999v13.993A2 2 0 0 1 18 20H2a2 2 0 0 1-2-1.999V4.008a2 2 0 0 1 2-1.999h2.973V.699a.7.7 0 0 1 .7-.699M1.4 7.742v10.259a.6.6 0 0 0 .6.6h16a.6.6 0 0 0 .6-.6V7.756zm5.267 6.877v1.666H5v-1.666zm4.166 0v1.666H9.167v-1.666zm4.167 0v1.666h-1.667v-1.666zm-8.333-3.977v1.666H5v-1.666zm4.166 0v1.666H9.167v-1.666zm4.167 0v1.666h-1.667v-1.666zM4.973 3.408H2a.6.6 0 0 0-.6.6v2.335l17.2.014V4.008a.6.6 0 0 0-.6-.6h-2.71v.929a.7.7 0 0 1-1.4 0v-.929H6.373v.92a.7.7 0 0 1-1.4 0z" />
                    </svg> <span>{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
                </div>
            </div>
        </div>

        <div class="p-3 border rounded bg-white shadow-sm align-items-center gap-3 d-flex flex-wrap justify-content-between">
            <div class="d-flex gap-3 align-items-center flex-wrap">
                <h5>Filter Ketersediaan -></h5>
                <div class="d-flex gap-2 align-items-center">
                    <form class="d-flex gap-2" action="{{ route('barang.filter') }}" enctype="multipart/form-data">
                        <select class="form-select" name="filter" id="filter">
                            <option {{ request('filter') == 'all' ? 'selected' : '' }} value="all">Semua</option>
                            <option {{ request('filter') == 'ada' ? 'selected' : '' }} value="ada">Ada</option>
                            <option {{ request('filter') == 'kosong' ? 'selected' : '' }} value="kosong">Kosong</option>
                        </select>

                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    <a href="{{ route('barang.list') }}" class="btn btn-warning">Reset</a>
                </div>
            </div>
            <div class="">
                <form action="{{ route('barang.search') }}" method="GET" class="d-flex gap-2">
                    <input type="text" class="form-control" name="q" placeholder="Cari barang">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            @forelse ($barangs as $barang)
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-3">
                        <h5 class="card-header text-white fw-medium {{ $barang->stokBarang->first()->stok > 0 ? 'bg-success' : 'bg-danger' }} ">
                            Stok {{ $barang->stokBarang->first()->stok > 0 ? 'Tersedia' : 'Tidak Tersedia' }}</h5>
                        <div class="card-body">
                            <h5 class="card-title fw-bolder">{{ $barang->nama_barang }}</h5>
                            <p class="card-text">Rp.{{ $barang->harga_jual }},-</p>
                            <p class="card-text">Kuantitas Barang :
                                <span class="fw-bold">{{ $barang->stokBarang->first()->stok . ' ' . $barang->stokBarang->first()->satuan->nama_satuan }}</span>
                            </p>
                            <p class="card-text">Supplier : {{ $barang->stokBarang->first()->supplier->nama_supplier }}</p>

                            <div class="d-flex gap-3">
                                <form action="{{ route('barang.in', $barang->id) }}" method="POST"
                                    class="input-group flex-nowrap">
                                    @csrf
                                    <input type="number" class="form-control" value="1" placeholder="1"
                                        aria-label="in-barang" name="in_barang" aria-describedby="addon-wrapping">
                                    <button type="submit" class="input-group-text" id="addon-wrapping">In</button>
                                </form>
                                <form action="{{ route('barang.out', $barang->id) }}" method="POST"
                                    class="input-group flex-nowrap">
                                    @csrf
                                    <input {{ $barang->stokBarang->first()->stok == 0 ? 'disabled' : '' }} type="number" class="form-control" value="1" placeholder="1"
                                        aria-label="out-barang" name="out_barang" aria-describedby="addon-wrapping">
                                    <button {{ $barang->stokBarang->first()->stok == 0 ? 'disabled' : '' }} type="submit" class="input-group-text" id="addon-wrapping">Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        Barang tidak ditemukan
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

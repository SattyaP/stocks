@extends('layouts.app')

@section('title', 'Detail Barang')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <img class="img-fluid" width="500" src="{{ $barang->image }}" alt="{{ $barang->nama_barang }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold">{{ 'Product ' . $barang->nama_barang }}</h1>
                <p>{{ 'Deskripsi : '. $barang->deskripsi }}</p>
                <p>{{ 'Harga Beli : Rp.'. $barang->harga_beli }}</p>
                <p>{{ 'Harga Jual : Rp.'. $barang->harga_jual }}</p>
                <p>{{ 'Qty : '. $barang->stokBarang->first()->stok . ' ' . $barang->stokBarang->first()->satuan->nama_satuan }}</p>
                <span class="badge text-bg-primary">{{ $barang->status }}</span>
            </div>

        </div>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary w-100">Kembali</a>
    </div>
@endsection


@extends('layouts.app')

@section('title', 'Edit Barang')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{ __('Edit Barang') }}</div>

                    <div class="card-body">
                        <form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <img class="img-fluid" src="{{ $barang->image }}" alt="{{ $barang->nama_barang }}"
                                width="150">

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Foto Barang') }}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">{{ __('Kode Barang') }}</label>
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                    value="{{ $barang->kode_barang }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">{{ __('Nama Barang') }}</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                    id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ $barang->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="harga_beli"
                                    class="form-label
                                ">{{ __('Harga Beli') }}</label>
                                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror"
                                    id="harga_beli" name="harga_beli" value="{{ $barang->harga_beli }}">
                                @error('harga_beli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="harga_jual"
                                    class="form-label
                                ">{{ __('Harga Jual') }}</label>
                                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror"
                                    id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}">
                                @error('harga_jual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">{{ __('Supplier') }}</label>
                                <select name="supplier_id" id="supplier_id"
                                    class="form-select @error('supplier_id') is-invalid @enderror">
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $barang->stokBarang->first()->supplier_id == $supplier->id ? 'selected' : '' }} >{{ $supplier->nama_supplier }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stok"
                                    class="form-label
                                ">{{ __('Stok') }}</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    id="stok" name="stok" value="{{ $barang->stokBarang->first()->stok }}">
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="Tersedia" {{ $barang->status == 1 ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="Kosong" {{ $barang->status == 0 ? 'selected' : '' }}>Kosong
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Tambah Satuan')

@section('content')
    <div class="container">
        <div class="d-flex">
            <div>
                <h2 class="fw-bold">Tambah Satuan</h2>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('barang.index') }}">Barang</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('satuan.index') }}">Satuan</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tambah Satuan
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tambah Satuan</div>
                    <div class="card-body">
                        <form action="{{ route('satuan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_satuan" class="form-label">Nama Satuan</label>
                                    <input type="text" class="form-control @error('nama_satuan') is-invalid @enderror" id="nama_satuan" name="nama_satuan" value="{{ old('nama_satuan') }}">
                                @error('nama_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

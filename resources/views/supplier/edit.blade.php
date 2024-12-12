@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
    <div class="container">
        <div class="d-flex">
            <div>
                <h2 class="fw-bold">Edit Supplier</h2>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('supplier.index') }}">Supplier</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Supplier
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Supplier</div>
                    <div class="card-body">
                        <form action="{{ route('supplier.update', $supplier) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_supplier" class="form-label">Nama Supplier</label>
                                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                                    id="nama_supplier" name="nama_supplier"
                                    value="{{ old('nama_supplier', $supplier->nama_supplier) }}">
                                @error('nama_supplier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Supplier</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="3">{{ old('alamat', $supplier->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="telepon_supplier" class="form-label">Telepon Supplier</label>
                                <input type="number" class="form-control @error('telepon_supplier') is-invalid @enderror"
                                    id="telepon_supplier" name="telepon"
                                    value="{{ old('telepon_supplier', $supplier->telepon) }}">
                                @error('telepon_supplier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

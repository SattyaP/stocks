@extends('layouts.app')

@section('title', 'Barang')
@section('content')
    <div class="container">
        <div class="d-flex">
            <div>
                <h2 class="fw-bold">Register Barang</h2>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-decoration-underline"><a href="{{ route('barang.list') }}">Manajemen
                                Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register Barang</li>
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

        <div class="row justify-content-center mt-3">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('Barang') }}</div>

                    <div class="card-body">
                        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">{{ __('Tambah Barang') }}</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Stok Barang</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangs as $barang)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <img class="img-fluid rounded" src="{{ $barang->image }}" alt="{{ $barang->nama_barang }}" width="100">
                                        </td>
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->stokBarang->first()->stok . ' ' . $barang->stokBarang->first()->satuan->nama_satuan }}</td>
                                        <td>{{ $barang->status }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('barang.show', $barang->kode_barang) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#fff" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                            </svg></a>
                                            <a href="{{ route('barang.edit', $barang) }}" class="btn btn-sm btn-warning">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="#fff" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5">
                                                        <path
                                                            d="M19.09 14.441v4.44a2.37 2.37 0 0 1-2.369 2.369H5.12a2.37 2.37 0 0 1-2.369-2.383V7.279a2.356 2.356 0 0 1 2.37-2.37H9.56" />
                                                        <path
                                                            d="M6.835 15.803v-2.165c.002-.357.144-.7.395-.953l9.532-9.532a1.36 1.36 0 0 1 1.934 0l2.151 2.151a1.36 1.36 0 0 1 0 1.934l-9.532 9.532a1.36 1.36 0 0 1-.953.395H8.197a1.36 1.36 0 0 1-1.362-1.362M19.09 8.995l-4.085-4.086" />
                                                    </g>
                                                </svg>
                                            </a>
                                            <form action="{{ route('barang.destroy', $barang) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#fff"
                                                            d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('Data barang kosong') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $barangs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection

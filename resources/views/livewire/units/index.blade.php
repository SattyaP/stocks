@section('title', 'List Units')

<div class="container">
    <div class="d-flex">
        <div>
            <h2 class="fw-bold">List Units</h2>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-decoration-underline"><a href="{{ route('units.index') }}">Managament
                            Units</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Units</li>
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
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('List Units') }}</div>

                <div class="card-body">
                    <div x-data="{ open: false }">
                        <button x-on:click="open = ! open" type="button"
                            class="btn btn-primary mb-3">{{ __('Add Unit') }}</button>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Unit Name</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $unit)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $unit->unit_name }}</td>
                                        <td>
                                            <button
                                                onclick="if(confirm('Are you sure you want to delete this unit?')) { @this.delete({{ $unit->id }}) }"
                                                class="btn btn-danger btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="#fff"
                                                        d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Unit Empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $units->links('pagination::bootstrap-5') }}

                        <div x-show="open">
                            @include('livewire.units.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

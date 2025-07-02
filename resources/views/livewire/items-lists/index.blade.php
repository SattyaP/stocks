@section('title', 'Management Stock')

<div class="container">
    <div class="d-flex">
        <div>
            <h2 class="fw-bold">Managament Items</h2>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-decoration-underline"><a href="{{ route('items.stock') }}">Management
                            Items</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Item</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <button type="button" wire:click='open' class="btn btn-primary d-flex align-items-center gap-2 px-2 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#fff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                </svg>
                Add Transaction
            </button>

            @if ($showModal)
                <div class="modal-backdrop fade show"></div>
                <div class="modal show d-block" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Add Transaction
                                </h5>

                                <button type="button" class="btn-close" wire:click='close'></button>
                            </div>

                            <div class="modal-body">
                                @if (session('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @elseif (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form wire:submit.prevent="store" class="row" enctype="multipart/form-data">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="item_id" class="form-label">Item</label>
                                            <select wire:model='item_id' wire:change="detailItem" class="form-select"
                                                id="item_id">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->item_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('item_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" wire:model='quantity' class="form-control"
                                                id="quantity" placeholder="Enter quantity">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="supplier_id" class="form-label">Supplier</label>
                                            <select wire:model='supplier_id' class="form-select" id="supplier_id">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">
                                                        {{ $supplier->name_supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="note" class="form-label">Note</label>
                                            <textarea wire:model='note' class="form-control" id="note" rows="3" placeholder="Enter note"></textarea>
                                            @error('note')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select wire:model='status' class="form-select" id="status">
                                                <option value="available">Available</option>
                                                <option value="not available">Not Available</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5>Detail Items</h5>
                                        @if ($image_url)
                                            <img src="{{ $image_url }}" alt="Item Image" class="img-fluid mb-3"
                                                style="max-height: 150px;">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="No Image"
                                                class="img-fluid mb-3" style="max-height: 150px;">
                                        @endif

                                        <div class="rounded border border-secondary-subtle p-2 mb-3 bg-light d-flex align-items-center"
                                            style="font-size: 1.1rem; font-weight: 500; border-width: 1px;">
                                            <span class="me-2">
                                                <!-- Barcode icon for Item Code -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#6c757d" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                                    <path
                                                        d="M1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0V2h1v12h-1v-1.5a.5.5 0 0 0-1 0v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-14A.5.5 0 0 0 3.5 1h-2zm13 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0V2h-1v12h1v-1.5a.5.5 0 0 1 1 0v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-14a.5.5 0 0 1 .5-.5h2z" />
                                                    <path
                                                        d="M5 2.5a.5.5 0 0 1 1 0v11a.5.5 0 0 1-1 0v-11zm2 0a.5.5 0 0 1 1 0v11a.5.5 0 0 1-1 0v-11zm2 0a.5.5 0 0 1 1 0v11a.5.5 0 0 1-1 0v-11z" />
                                                </svg>
                                            </span>
                                            <span class="fs-6">{{ $item_code ?? '-' }}</span>
                                        </div>

                                        <div class="rounded border border-secondary-subtle p-2 mb-3 bg-light d-flex align-items-center"
                                            style="font-size: 1.1rem; font-weight: 500; border-width: 1px;">
                                            <span class="me-2">
                                                <!-- Tag icon for Item Name -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#6c757d" class="bi bi-tag" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2 2v4.586l7.293 7.293a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414L8 2H2zm1 1h4.586l7 7-4.586 4.586-7-7V3zm1.5 1a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                </svg>
                                            </span>
                                            <span class="fs-6">{{ $item_name ?? '-' }}</span>
                                        </div>

                                        <div class="rounded border border-secondary-subtle p-2 mb-3 bg-light d-flex align-items-center"
                                            style="font-size: 1.1rem; font-weight: 500; border-width: 1px;">
                                            <span class="me-2">
                                                <!-- Currency icon for Purchase Price -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#6c757d" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.5 13.5a2.5 2.5 0 1 1-5 0c0-1.086.627-2.02 1.5-2.45V6.95C4.127 6.52 3.5 5.586 3.5 4.5a2.5 2.5 0 1 1 5 0c0 1.086-.627 2.02-1.5 2.45v4.1c.873.43 1.5 1.364 1.5 2.45z" />
                                                </svg>
                                            </span>
                                            <span class="fs-6">{{ $purchase_price ?? '-' }}</span>
                                        </div>

                                        <div class="rounded border border-secondary-subtle p-2 mb-3 bg-light d-flex align-items-center"
                                            style="font-size: 1.1rem; font-weight: 500; border-width: 1px;">
                                            <span class="me-2">
                                                <!-- Ruler icon for Unit -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#6c757d" class="bi bi-rulers" viewBox="0 0 16 16">
                                                    <path
                                                        d="M1.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5h-13zm.5 1h12v12h-12V2zm2 2v1h1V4H4zm2 0v1h1V4H6zm2 0v1h1V4H8zm2 0v1h1V4h-1zm-8 2v1h1V6H2zm2 0v1h1V6H4zm2 0v1h1V6H6zm2 0v1h1V6H8zm2 0v1h1V6h-1zm-8 2v1h1V8H2zm2 0v1h1V8H4zm2 0v1h1V8H6zm2 0v1h1V8H8zm2 0v1h1V8h-1zm-8 2v1h1v-1H2zm2 0v1h1v-1H4zm2 0v1h1v-1H6zm2 0v1h1v-1H8zm2 0v1h1v-1h-1zm-8 2v1h1v-1H2zm2 0v1h1v-1H4zm2 0v1h1v-1H6zm2 0v1h1v-1H8zm2 0v1h1v-1h-1z" />
                                                </svg>
                                            </span>
                                            <span class="fs-6">{{ $unit ?? '-' }}</span>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            wire:click='close'>Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save
                                            Transaction</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <livewire:items.list-item wire:key="list-transactions" />
</div>

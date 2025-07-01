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
            <button type="button" wire:click='open' class="btn btn-success d-flex align-items-center gap-2 px-2 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#fff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                </svg>
                Add Transaction
            </button>

            @if ($showModal)
                <div class="modal-backdrop fade show"></div>
                <div class="modal show d-block" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
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

                                <form wire:submit.prevent="store" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="item_id" class="form-label">Item</label>
                                        <select wire:model='item_id' class="form-select" id="item_id">
                                            <option value="">Select Item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('item_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" wire:model='quantity' class="form-control" id="quantity"
                                            placeholder="Enter quantity">
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="supplier_id" class="form-label">Supplier</label>
                                        <select wire:model='supplier_id' class="form-select" id="supplier_id">
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name_supplier }}
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

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            wire:click='close'>Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Transaction</button>
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

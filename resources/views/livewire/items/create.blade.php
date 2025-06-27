@section('title', 'Add Items')

<div class="container">
    <div class="d-flex">
        <div>
            <h2 class="fw-bold">Add Items</h2>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-decoration-underline"><a href="{{ route('items.list') }}">Add
                            Items</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Item</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Items') }}</div>

                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="mt-2 mb-2" width="100">
                            @endif

                            <label for="image" class="form-label">{{ __('Image Item') }}</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                id="image" wire:model="image" accept="image/jpeg,image/jpg,image/png">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="item_name" class="form-label">{{ __('Item Name') }}</label>
                            <input type="text" class="form-control @error('item_name') is-invalid @enderror"
                                id="item_name" wire:model.defer="item_name">
                            @error('item_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">{{ __('Stock') }}</label>
                            <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror"
                                id="stock_quantity" wire:model.defer="stock_quantity">
                            @error('stock_quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit_id" class="form-label">{{ __('Units') }}</label>
                            <select id="unit_id" wire:model.defer="unit_id"
                                class="form-select @error('unit_id') is-invalid @enderror">
                                <option value="">-- Choose Units --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="purchase_price" class="form-label">{{ __('Purchase Price') }}</label>
                            <input type="number" class="form-control @error('purchase_price') is-invalid @enderror"
                                id="purchase_price" wire:model.defer="purchase_price">
                            @error('purchase_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select id="status" wire:model.defer="status"
                                class="form-select @error('status') is-invalid @enderror">
                                <option value="">-- Choose Status --</option>
                                <option value="available">Available</option>
                                <option value="empty">Empty</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <button wire:click='submit_and_create' class="btn btn-warning">Save and Create More</button>
                        <a class="btn btn-secondary" href="{{ route('items.index') }}">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

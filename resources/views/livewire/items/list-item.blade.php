<div>
    <div class="p-3 border rounded bg-white shadow-sm align-items-center gap-3 d-flex flex-wrap justify-content-between">
        <div class="d-flex gap-3 align-items-center flex-wrap">
            <h5>Filter Availability -></h5>
            <div class="d-flex gap-2 align-items-center">
                <select wire:model='filter_box' class="form-select" name="filter" id="filter" wire:change="filter">
                    <option value="all">All</option>
                    <option value="available">Available</option>
                    <option value="empty">Empty</option>
                </select>
            </div>
        </div>
        <div class="">
            <form wire:submit.prevent='search' class="d-flex gap-2">
                <input type="text" class="form-control" wire:model.defer='q' name="q"
                    placeholder="Search item">
                <button type="submit" class="btn btn-secondary">Search</button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        @foreach ($this->transactions as $transaction)
            <div class="col-lg-4 col-md-6">
                <div wire:key="trx-{{ $transaction->id }}" class="card mb-3">
                    <div
                        class="card-header d-flex align-items-center {{ $transaction->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                        <h5 class="text-white fw-medium mb-0 mx-auto">
                            {{ $transaction->quantity > 0 ? 'Stock Available' : 'Stock Empty' }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bolder">{{ $transaction->item->item_name }}</h5>
                        <p class="card-text">
                            Rp.{{ number_format((float) ($transaction->item->purchase_price ?? 0) * (float) ($transaction->quantity ?? 0), 3, ',', '.') }},-
                        </p>
                        <p class="card-text">Quantity :
                            <span
                                class="fw-bold">{{ $transaction->quantity . ' ' . $transaction->item->unit->unit_name }}</span>
                        </p>
                        <p class="card-text">Supplier : {{ $transaction->supplier->name_supplier ?? '-' }}</p>
                        <div class="d-flex gap-3">
                            <form wire:submit.prevent='increaseStock({{ $transaction->id }})'
                                class="input-group flex-nowrap">
                                <input type="number" class="form-control" value="1" placeholder="1"
                                    aria-label="in-item" wire:model.defer='in_count.{{ $transaction->id }}'
                                    name="in_item_{{ $transaction->id }}" aria-describedby="addon-wrapping">
                                <button type="submit" class="input-group-text" id="addon-wrapping">In</button>
                            </form>
                            <form wire:submit.prevent='decreaseStock({{ $transaction->id }})'
                                class="input-group flex-nowrap">
                                <input type="number" class="form-control" value="1" placeholder="1"
                                    aria-label="out-item" name="out_item_{{ $transaction->id }}"
                                    wire:model.defer='out_count.{{ $transaction->id }}'
                                    aria-describedby="addon-wrapping">
                                <button type="submit" class="input-group-text" id="addon-wrapping">Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

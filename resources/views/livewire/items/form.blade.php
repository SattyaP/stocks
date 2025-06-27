<div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="modal show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Item</h5>
                    <button type="button" class="btn-close" @click="open = false"></button>
                </div>

                <form wire:submit.prevent="store" enctype="multipart/form-data" method="POST">

                    <input type="text" wire:model.defer="item_name" class="form-control" placeholder="Nama Barang">
                    <input type="number" wire:model.defer="stock_quantity" class="form-control mt-2"
                        placeholder="Stok">
                    <input type="number" wire:model.defer="purchase_price" class="form-control mt-2"
                        placeholder="Harga Beli">

                    <select wire:model.defer="unit_id" class="form-control mt-2">
                        <option value="">Pilih Satuan</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                        @endforeach
                    </select>

                    <select wire:model.defer="status" class="form-control mt-2">
                        <option value="available">Tersedia</option>
                        <option value="empty">Habis</option>
                    </select>

                    <input type="file" wire:model="image" class="form-control mt-2">
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="open = false">Batal</button>
                    <button type="submit" class="btn btn-primary">Save Item</button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" class="modal-backdrop fade show"></div>
</div>

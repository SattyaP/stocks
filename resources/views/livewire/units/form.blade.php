<div class="modal show d-block" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form wire:submit.prevent="store" @submit="open = false">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalLabel">Add Unit</h5>
                    <button type="button" class="btn-close" @click="open = false" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="unit_name" class="form-label">Unit Name</label>
                        <input type="text" wire:model="unit_name" class="form-control" id="unit_name">
                        @error('unit_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="open = false" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Create Unit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>

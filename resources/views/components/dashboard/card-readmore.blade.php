<div class="col-md-3 mb-3">
    <div class="card h-100" style="border-left: 5px solid #007bff;">
        <div class="card-body">
            <h5 class="card-title fw-bold">{{ $headline }}</h5>
            <p class="card-text">{{ $description }}</p>
            <a wire:navigate href="{{ $link }}" class="btn btn-primary">Lihat</a>
        </div>
    </div>
</div>

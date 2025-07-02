@section('title', 'Dashboard')

<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h2 class="fw-bold">Dashboard</h2>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-decoration-underline"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">#</li>
                </ol>
            </nav>
        </div>

        <div class="bg-secondary text-white p-2 rounded d-flex gap-2 align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <path fill="#fff"
                    d="M5.673 0a.7.7 0 0 1 .7.7v1.309h7.517v-1.3a.7.7 0 0 1 1.4 0v1.3H18a2 2 0 0 1 2 1.999v13.993A2 2 0 0 1 18 20H2a2 2 0 0 1-2-1.999V4.008a2 2 0 0 1 2-1.999h2.973V.699a.7.7 0 0 1 .7-.699M1.4 7.742v10.259a.6.6 0 0 0 .6.6h16a.6.6 0 0 0 .6-.6V7.756zm5.267 6.877v1.666H5v-1.666zm4.166 0v1.666H9.167v-1.666zm4.167 0v1.666h-1.667v-1.666zm-8.333-3.977v1.666H5v-1.666zm4.166 0v1.666H9.167v-1.666zm4.167 0v1.666h-1.667v-1.666zM4.973 3.408H2a.6.6 0 0 0-.6.6v2.335l17.2.014V4.008a.6.6 0 0 0-.6-.6h-2.71v.929a.7.7 0 0 1-1.4 0v-.929H6.373v.92a.7.7 0 0 1-1.4 0z" />
            </svg>
            <span>{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Total Items Registerd -->
        <x-dashboard.card-readmore headline="Item" :description="'Total Items registered: ' . $totalItemRegistered" link="{{ route('items.index') }}" />

        <!-- Total Suppliers -->
        <x-dashboard.card-readmore headline="Supplier" :description="'Total Suppliers: ' . $totalSuppliers" link="{{ route('suppliers.index') }}" />

        <!-- Total Transactions -->
        <x-dashboard.card-qty headline="Transaction" :description="'Total Kekayaan'" :value="$totalTransactions" />

        <!-- Total Items Transaction -->
        <x-dashboard.card-qty headline="Transaction" :description="'Total Quantity Item Transaction'" :value="$totalItemsTransaction" />
    </div>

    <!-- Chart Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Transactions Overview</h5>
                    <canvas id="dashboardChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function renderDashboardChart() {
            const chartCanvas = document.getElementById('dashboardChart');
            if (!chartCanvas) return;
            if (window.dashboardChartInstance) {
                window.dashboardChartInstance.destroy();
            }
            const ctx = chartCanvas.getContext('2d');
            window.dashboardChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
                    datasets: [{
                        label: 'Transactions',
                        data: {!! json_encode($chartData ?? [12, 19, 3, 5, 2, 3]) !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', renderDashboardChart);
        document.addEventListener('livewire:navigated', renderDashboardChart);
        document.addEventListener('livewire:load', renderDashboardChart);
    </script>
@endpush

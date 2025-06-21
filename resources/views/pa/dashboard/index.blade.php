@extends('pa.layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-x-4">
        <div class="col-span-full card p-3 sm:p-7">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-3 sm:pb-7">
                <div>
                    <h6 class="card-title isd">Dashboard Produk & Transaksi</h6>
                    <p class="card-description">Selamat datang di Dashboard Toko Online</p>
                </div>
                <form method="GET" class="flex items-center gap-4">
                    <input type="text" name="date_range" id="date_range" class="form-input h-[42px]"
                        placeholder="Select date range" />
                    <button type="submit" class="btn b-solid btn-primary-solid dk-theme-card-square">
                        <i class="ri-filter-3-line mr-1"></i> Filter
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-12 gap-4">
                <x-dashboard-card title="Total Produk" :value="$totalProducts" chartId="product-chart" icon="ri-box-3-line" />
                <x-dashboard-card title="Total Kategori" :value="$totalCategories" chartId="category-chart"
                    icon="ri-folders-line" />
                <x-dashboard-card title="Total Customer" :value="$totalCustomers" chartId="customer-chart" icon="ri-user-line" />
                <x-dashboard-card title="Total Order" :value="$totalOrders" chartId="order-chart" icon="ri-shopping-bag-line" />

                <x-dashboard-card title="Total Keuntungan" :value="'Rp ' . number_format($totalProfit, 0, ',', '.')" chartId="profit-chart"
                    icon="ri-money-dollar-circle-line" />
                <x-dashboard-card title="Transaksi Sukses" :value="$successfulOrders" chartId="success-chart"
                    icon="ri-check-double-line" />
                <x-dashboard-card title="Transaksi Gagal" :value="$failedOrders" chartId="fail-chart"
                    icon="ri-close-circle-line" />
                <x-dashboard-card title="Rata-rata Order per Hari" :value="$averageOrderPerDay" chartId="avg-order-chart"
                    icon="ri-bar-chart-grouped-line" />

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(function() {
            $('#date_range').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>
@endpush

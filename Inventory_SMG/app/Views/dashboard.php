<div class="content-wrapper" style="min-height: 650px;">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_products ?></h3>
                            <p>Total Produk</p>
                        </div>
                        <div class="icon"><i class="fas fa-box"></i></div>
                        <a href="<?= site_url('products') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_incoming ?></h3>
                            <p>Total Barang Masuk</p>
                        </div>
                        <div class="icon"><i class="fas fa-arrow-down"></i></div>
                        <a href="<?= site_url('incoming-items') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $total_outgoing ?></h3>
                            <p>Total Barang Keluar</p>
                        </div>
                        <div class="icon"><i class="fas fa-arrow-up"></i></div>
                        <a href="<?= site_url('outgoing-items') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $total_purchases ?></h3>
                            <p>Total Pembelian</p>
                        </div>
                        <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                        <a href="<?= site_url('purchases') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Pie Chart Transaksi Hari Ini -->

            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-success text-white">
                    <h5 class="card-title"><i class="fas fa-warehouse"></i> Stok Terkini</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($stock_summary as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= esc($item['name']) ?>
                                <span class="badge badge-pill badge-primary"><?= esc($item['stock']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Bar Chart Barang Masuk vs Keluar -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card card-danger shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-chart-pie"></i> Transaksi Hari Ini</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="height: 300px; max-height: 300px; width: 100%;"></canvas>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card card-success shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-chart-bar"></i> Stok Produk (Masuk vs Keluar)</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" style="min-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart Transaksi Hari Ini
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Barang Masuk', 'Barang Keluar'],
            datasets: [{
                data: [<?= $today_incoming ?>, <?= $today_outgoing ?>],
                backgroundColor: ['#28a745', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Bar Chart Stok Masuk vs Keluar
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: [<?php foreach ($stock_summary as $item) {
                            echo "'" . esc($item['name']) . "',";
                        } ?>],
            datasets: [{
                    label: 'Barang Masuk',
                    backgroundColor: '#17a2b8',
                    data: [<?php foreach ($stock_summary as $item) {
                                echo esc($item['incoming']) . ',';
                            } ?>]
                },
                {
                    label: 'Barang Keluar',
                    backgroundColor: '#dc3545',
                    data: [<?php foreach ($stock_summary as $item) {
                                echo esc($item['outgoing']) . ',';
                            } ?>]
                }
            ]
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
</script>
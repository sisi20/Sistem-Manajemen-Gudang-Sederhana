<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1>Laporan Inventory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Filter Global untuk Barang Masuk/Keluar -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-filter mr-2"></i>Filter Barang Masuk & Keluar</h5>
                </div>
                <div class="card-body">
                    <form method="get" action="<?= base_url('/reports') ?>" class="form-inline">
                        <div class="input-group mr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Dari</span>
                            </div>
                            <input type="date" name="start_date" class="form-control" value="<?= esc($start_date ?? '') ?>">
                        </div>
                        <div class="input-group mr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sampai</span>
                            </div>
                            <input type="date" name="end_date" class="form-control" value="<?= esc($end_date ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-search mr-1"></i>Filter</button>
                    </form>
                </div>
            </div>

            <!-- Tabbed Reports -->
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="report-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-stock-tab" data-toggle="pill" href="#tab-stock" role="tab" aria-controls="tab-stock" aria-selected="true">
                                <i class="fas fa-warehouse mr-1"></i>Stok Terkini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-incoming-tab" data-toggle="pill" href="#tab-incoming" role="tab" aria-controls="tab-incoming" aria-selected="false">
                                <i class="fas fa-box-open mr-1"></i>Barang Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-outgoing-tab" data-toggle="pill" href="#tab-outgoing" role="tab" aria-controls="tab-outgoing" aria-selected="false">
                                <i class="fas fa-truck-loading mr-1"></i>Barang Keluar
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="report-tabs-content">

                        <!-- Stok Terkini -->
                        <div class="tab-pane fade show active" id="tab-stock" role="tabpanel" aria-labelledby="tab-stock-tab">
                            <div class="table-responsive">
                                <table id="stockReport" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($products as $product): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= esc($product['name']) ?></td>
                                                <td><?= esc($product['stock']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Barang Masuk -->
                        <div class="tab-pane fade" id="tab-incoming" role="tabpanel" aria-labelledby="tab-incoming-tab">
                            <div class="table-responsive">
                                <table id="incomingReport" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($incoming_items as $item): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= esc($item['product_name']) ?></td>
                                                <td><?= esc($item['quantity']) ?></td>
                                                <td><?= esc($item['received_at']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Barang Keluar -->
                        <div class="tab-pane fade" id="tab-outgoing" role="tabpanel" aria-labelledby="tab-outgoing-tab">
                            <div class="table-responsive">
                                <table id="outgoingReport" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($outgoing_items as $item): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= esc($item['product_name']) ?></td>
                                                <td><?= esc($item['quantity']) ?></td>
                                                <td><?= esc($item['issued_at']) ?></td>
                                                <td><?= esc($item['note']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div><!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1>Laporan Inventory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Filter Global untuk Barang Masuk/Keluar -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-filter mr-2"></i>Filter Barang Masuk & Keluar</h5>
                </div>
                <div class="card-body">
                    <form method="get" action="<?= base_url('/reports') ?>" class="form-inline">
                        <div class="input-group mr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Dari</span>
                            </div>
                            <input type="date" name="start_date" class="form-control" value="<?= esc($start_date ?? '') ?>">
                        </div>
                        <div class="input-group mr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sampai</span>
                            </div>
                            <input type="date" name="end_date" class="form-control" value="<?= esc($end_date ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-search mr-1"></i>Filter</button>
                    </form>
                </div>
            </div>

            <!-- Tabbed Reports -->
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="report-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-stock-tab" data-toggle="pill" href="#tab-stock" role="tab" aria-controls="tab-stock" aria-selected="true">
                                <i class="fas fa-warehouse mr-1"></i>Stok Terkini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-incoming-tab" data-toggle="pill" href="#tab-incoming" role="tab" aria-controls="tab-incoming" aria-selected="false">
                                <i class="fas fa-box-open mr-1"></i>Barang Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-outgoing-tab" data-toggle="pill" href="#tab-outgoing" role="tab" aria-controls="tab-outgoing" aria-selected="false">
                                <i class="fas fa-truck-loading mr-1"></i>Barang Keluar
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="report-tabs-content">

                        <!-- Stok Terkini -->
                        <div class="tab-pane fade show active" id="tab-stock" role="tabpanel" aria-labelledby="tab-stock-tab">
                            <div class="table-responsive">
                                <table id="stockReport" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($products as $product): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= esc($product['name']) ?></td>
                                                <td><?= esc($product['stock']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Barang Masuk -->
                        <div class="tab-pane fade" id="tab-incoming" role="tabpanel" aria-labelledby="tab-incoming-tab">
                            <div class="table-responsive">
                                <table id="incomingReport" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($incoming_items as $item): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= esc($item['product_name']) ?></td>
                                                <td><?= esc($item['quantity']) ?></td>
                                                <td><?= esc($item['received_at']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Barang Keluar -->
                        <div class="tab-pane fade" id="tab-outgoing" role="tabpanel" aria-labelledby="tab-outgoing-tab">
                            <div class="table-responsive">
                                <table id="outgoingReport" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($outgoing_items as $item): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= esc($item['product_name']) ?></td>
                                                <td><?= esc($item['quantity']) ?></td>
                                                <td><?= esc($item['issued_at']) ?></td>
                                                <td><?= esc($item['note']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
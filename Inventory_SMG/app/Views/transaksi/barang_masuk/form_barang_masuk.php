<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Barang Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Tambah Barang Masuk</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">Form Tambah Barang Masuk</h3>
                        </div>

                        <form action="<?= site_url('incoming-items/store') ?>" method="post">
                            <input type="hidden" name="purchase_id" value="<?= esc($purchase['id']) ?>">
                            <div class="card-body">

                                <!-- Daftar Item Pembelian -->
                                <?php
                                $hasRemaining = false;
                                if (!empty($items)): ?>
                                    <?php foreach ($items as $item): ?>
                                        <?php
                                        $remaining = $item['quantity'] - $item['total_received'];
                                        if ($remaining > 0):
                                            $hasRemaining = true;
                                        ?>
                                            <div class="form-group mb-3">
                                                <label>
                                                    <?= esc($item['product_name']) ?>
                                                    (Order: <?= esc($item['quantity']) ?> <?= esc($item['unit']) ?>,
                                                    Sisa: <?= esc($remaining) ?>)
                                                </label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    name="items[<?= esc($item['id']) ?>]"
                                                    min="0"
                                                    max="<?= esc($remaining) ?>"
                                                    value="0"
                                                    placeholder="Masukkan jumlah diterima">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if (!$hasRemaining): ?>
                                        <p class="text-success mb-0">
                                            ✅ Semua item pembelian ini sudah diterima.
                                        </p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <p class="text-danger mb-0">
                                        Tidak ada item pembelian untuk ditambahkan.
                                    </p>
                                <?php endif; ?>

                                <!-- Tanggal Masuk -->
                                <div class="form-group mt-3">
                                    <label for="received_at">Tanggal Masuk</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="received_at"
                                        name="received_at"
                                        value="<?= date('Y-m-d') ?>"
                                        required>
                                </div>

                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= site_url('/purchase-item/' . $purchase['id']) ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Batal
                                </a>

                                <?php if ($hasRemaining): ?>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-success" disabled>
                                        <i class="fas fa-check"></i> Semua Barang Sudah Diterima
                                    </button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Barang Keluar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Tambah Barang Keluar</li>
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
                            <h3 class="card-title text-white">Form Tambah Barang Keluar</h3>
                        </div>

                        <form action="<?= site_url('outgoing-item/store') ?>" method="post">
                            <div class="card-body">

                                <!-- Pilih Produk -->
                                <div class="form-group">
                                    <label for="product_id">Produk</label>
                                    <select
                                        name="product_id"
                                        id="product_id"
                                        class="form-control select2"
                                        required>
                                        <option value="">-- Pilih Produk --</option>
                                        <?php foreach ($products as $product): ?>
                                            <option value="<?= esc($product['id']) ?>">
                                                <?= esc($product['name']) ?> (Stok: <?= esc($product['stock']) ?> <?= esc($product['unit']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Jumlah Keluar -->
                                <div class="form-group">
                                    <label for="quantity">Jumlah Keluar</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="quantity"
                                        name="quantity"
                                        min="1"
                                        placeholder="Masukkan jumlah"
                                        required>
                                </div>

                                <!-- Tanggal Keluar -->
                                <div class="form-group">
                                    <label for="issued_at">Tanggal Keluar</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="issued_at"
                                        name="issued_at"
                                        value="<?= date('Y-m-d') ?>"
                                        required>
                                </div>

                                <!-- Catatan -->
                                <div class="form-group">
                                    <label for="note">Catatan</label>
                                    <textarea
                                        class="form-control"
                                        id="note"
                                        name="note"
                                        rows="2"
                                        placeholder="Opsional, isi catatan barang keluar"></textarea>
                                </div>

                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= site_url('/outgoing-items') ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Batal
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
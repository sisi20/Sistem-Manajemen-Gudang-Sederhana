<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= isset($item) ? 'Edit Item Pembelian' : 'Tambah Item Pembelian' ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('purchases') ?>">Master Data</a></li>
                        <li class="breadcrumb-item active"><?= isset($item) ? 'Edit Item Pembelian' : 'Tambah Item Pembelian' ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">
                                <?= isset($item) ? 'Form Edit Item Pembelian' : 'Form Tambah Item Pembelian' ?>
                            </h3>
                        </div>

                        <form action="<?= isset($formAction) ? $formAction : site_url('purchase_item/store') ?>" method="post">
                            <!-- Hidden purchase_id -->
                            <input type="hidden" name="purchase_id" value="<?= isset($purchase_id) ? $purchase_id : (isset($item) ? $item['purchase_id'] : '') ?>">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_id">Produk</label>
                                    <select class="form-control" id="product_id" name="product_id" required>
                                        <option value="">-- Pilih Produk --</option>
                                        <?php foreach ($products as $product): ?>
                                            <option value="<?= $product['id'] ?>"
                                                <?= isset($item) && $item['product_id'] == $product['id'] ? 'selected' : '' ?>>
                                                <?= $product['name'] ?> (<?= $product['unit'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Jumlah</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Masukkan jumlah produk"
                                        value="<?= isset($item) ? $item['quantity'] : '' ?>" min="1" required>
                                </div>

                                <div class="form-group">
                                    <label for="unit_price">Harga Satuan</label>
                                    <input type="number" class="form-control" id="unit_price" name="unit_price"
                                        placeholder="Masukkan harga satuan"
                                        value="<?= isset($item) ? $item['unit_price'] : '' ?>" min="0" step="0.01" required>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= base_url('purchase-item/' . $purchase['id']) ?>" class="btn btn-secondary">
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
<!-- /.content-wrapper -->
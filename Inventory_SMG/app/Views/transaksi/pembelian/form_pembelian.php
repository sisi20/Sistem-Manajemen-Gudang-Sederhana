<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= isset($purchase) ? 'Edit Pembelian' : 'Tambah Pembelian' ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active"><?= isset($purchase) ? 'Edit Pembelian' : 'Tambah Pembelian' ?></li>
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
                                <?= isset($purchase) ? 'Form Edit Pembelian' : 'Form Tambah Pembelian' ?>
                            </h3>
                        </div>

                        <form action="<?= isset($formAction) ? $formAction : site_url('purchase/store') ?>" method="post">
                            <div class="card-body">
                                <!-- Vendor -->
                                <div class="form-group">
                                    <label for="vendor_id">Nama Vendor</label>
                                    <select class="form-control" id="vendor_id" name="vendor_id" required>
                                        <option value="">-- Pilih Vendor --</option>
                                        <?php foreach ($vendors as $vendor): ?>
                                            <option value="<?= $vendor['id'] ?>"
                                                <?= isset($purchase) && $purchase['vendor_id'] == $vendor['id'] ? 'selected' : '' ?>>
                                                <?= $vendor['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Buyer Name -->
                                <div class="form-group">
                                    <label for="buyer_name">Nama Pembeli</label>
                                    <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                                        placeholder="Masukkan nama pembeli"
                                        value="<?= isset($purchase) ? $purchase['buyer_name'] : '' ?>" required>
                                </div>

                                <!-- Purchase Date -->
                                <div class="form-group">
                                    <label for="purchase_date">Tanggal Pembelian</label>
                                    <input type="date" class="form-control" id="purchase_date" name="purchase_date"
                                        value="<?= isset($purchase) ? $purchase['purchase_date'] : date('Y-m-d') ?>" required>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Pending" <?= isset($purchase) && $purchase['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="Completed" <?= isset($purchase) && $purchase['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="Cancelled" <?= isset($purchase) && $purchase['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= site_url('purchases') ?>" class="btn btn-secondary">
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
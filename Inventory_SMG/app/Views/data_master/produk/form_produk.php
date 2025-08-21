<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= isset($category) ? 'Edit Kategori' : 'Tambah Kategori' ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active"><?= isset($category) ? 'Edit Produk' : 'Tambah Produk' ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">
                                <?= isset($product) ? 'Form Edit Produk' : 'Form Tambah Produk' ?>
                            </h3>
                        </div>
                        <form action="<?= isset($formAction) ? $formAction : site_url('product/store') ?>" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_name">Nama Produk</label>
                                    <input type="text" class="form-control" id="product_name" name="name"
                                        placeholder="Masukkan nama produk"
                                        value="<?= isset($product) ? $product['name'] : '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="code">Kode Produk</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        placeholder="Masukkan kode produk"
                                        value="<?= isset($product) ? $product['code'] : '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>"
                                                <?= isset($product) && $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                                <?= $cat['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="unit">Satuan</label>
                                    <input type="text" class="form-control" id="unit" name="unit"
                                        placeholder="Masukkan satuan produk"
                                        value="<?= isset($product) ? $product['unit'] : '' ?>" required>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="<?= site_url('products') ?>" class="btn btn-secondary">
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